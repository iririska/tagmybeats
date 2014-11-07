import struct
from pydub import AudioSegment
import MySQLdb
import os
import random
AudioSegment.ffmpeg = "/usr/local/bin/ffmpeg"

def makef(main, tag, delay,out, repeats,start):
    print main
    print "<br>"
    print tag
    print "<br>"
    filetempdir = "/home/beattagger/public_html/test/temp/"
    
    tagext = tag.split(".")[-1]
    mainext = main.split(".")[-1]
    if tagext =="wav":
        sound1 = AudioSegment.from_wav(tag)
    if tagext =="mp3":
        randstr = str(random.randint(10000,99999))
        os.system("/usr/local/bin/ffmpeg -i "+tag+"  "+filetempdir+randstr+".wav")
        sound1 = AudioSegment.from_wav(filetempdir+randstr+".wav")
        os.remove(filetempdir+randstr+".wav")
    print "ok111"
    if mainext=="wav":
        sound2 = AudioSegment.from_wav(main)
    if mainext=="mp3":
        randstr = str(random.randint(10000,99999))
        os.system("/usr/local/bin/ffmpeg -i "+main+"  "+filetempdir+randstr+".wav")
        sound2 = AudioSegment.from_wav(filetempdir+randstr+".wav")
        os.remove(filetempdir+randstr+".wav")

    print "ok111"
    #sound1 = AudioSegment.from_wav(tag)
    #sound2 = AudioSegment.from_wav(main)
    print "yes"
    rate = sound2.frame_rate

    fraglen = rate * delay
    countfrags = sound2.frame_count() / fraglen
    wmlen = sound1.frame_count()
    
    if repeats+1 < countfrags:
        countfrags = repeats+1

    for i in range(0, int(countfrags)-1):
      ol = (i * delay * 1000)+(start*1000)
      print ol
      sound2 = sound2.overlay(sound1, position=ol)
    if mainext=="mp3":
        randstr = str(random.randint(10000,99999))+"final"
        sound2.export("/home/beattagger/public_html/test/temp/"+randstr+".wav", format="wav")
        os.system("/usr/local/bin/ffmpeg -i /home/beattagger/public_html/test/temp/"+randstr+".wav "+out )
        os.remove("/home/beattagger/public_html/test/temp/"+randstr+".wav")
    if mainext=="wav":  
        sound2.export(out, format=mainext)


db = MySQLdb.connect(host="localhost", user="beattagg_test", passwd="666666a", db="beattagg_test", charset='utf8')
#db.autocommit(True)
cursor = db.cursor()

sql = """SELECT * from soundpro where proceed = 0 and begined = 0"""
path = "/home/beattagger/public_html/test/"
cursor.execute(sql)
#db.commit()
data =  cursor.fetchall()
for rec in data:
    print "st<br>"+str(rec[0])+"<br>"
    cursor.execute("""UPDATE soundpro set begined=%s where id=%s""",("1", str(rec[0])))
    db.commit()
    print "555"
    print rec[2]
    print rec[3]
    makef(path+rec[2],path+rec[3],int(rec[6]),path+"upload/"+rec[8], int(rec[7]), int(rec[14]))
    cursor.execute("""UPDATE soundpro set proceed=%s where id=%s""",("1",str(rec[0])))
    db.commit()
hello = "hello"
world = "world"
print hello + " " + world

cursor.close()
db.commit()
db.close()