<script>
    $(function() {
        $(document).on('click', ".deleteone", function() {
        var id = $(this).attr('class').split(' ')[1];
        if (confirm("Do you want to delete this files?"))
        {
            $.get( "ajaxdel?delete="+id+"&email="+$("#checkedemail").val(), function( data ) {
                $( "#reztable" ).html( data );
               //alert( data);
            });
        }
        return false;
        });

        $(document).on('click', ".playmusic", function() {
            var musicurl = $(this).prev().attr("href");
            //alert(musicurl);
            $("#audplayer").html("<audio src='"+musicurl+"' controls autoplay></audio>");
        });

        $( "#sendbutton" ).click(function() {
            $("#checkedemail").val($("#byemail").val());
            $.get( "ajaxdel?email="+$("#byemail").val(), function( data ) {
                $( "#reztable" ).html( data );
            //alert( data);
        });

        return false;


        });
    });
</script>
    <? if ($admlogin) { ?>
    <div class="page_content"> 
        <form role="form" method="post" action="index">
            <div class="form-group">
                <label for="delay">Find by email</label>
                <input type="text" class="form-control" id="byemail" name="byemail" placeholder="Enter email">
           </div>
            <button type="submit" id="sendbutton" class="btn btn-default">Submit</button>
            <input type="hidden" name="checkedemail" id="checkedemail" value="">
        </form>
        <br >
        <div id="audplayer"><!-- <audio src="" controls></audio>--> </div>
    </div>
    <table class="table" id="reztable">
        <thead>
            <tr>
                <th>User</th>
                <th>main file</th>
                <th>tag file</th>
                <th>result file</th>
                <th>delay</th>
                <th>repeats</th>
                <th>start</th>
                <th>addtime</th>
                <th>proceed</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
        <? foreach($tasks as $usr) { 
            $username = $usr['Siteuser']['email'];
            foreach($usr['Task'] as $row) {
                ?>
                <tr>
                    <td><?=$username;?></td>
                    <td>
                        <a href="../test/<?=$row['mainfile'];?>"><?=$row['mainfile_name'];?></a>
                        <button type="button" class="playmusic btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-music"></span>
                        </button>
                    </td>
                    <td><a href="../test/<?=$row['tagfile'];?>"><?=$row['tagfile_name'];?></a>
                        <button type="button" class="playmusic btn btn-default btn-xs">
                        <span class="glyphicon glyphicon-music"></span>
                        </button>
                    </td>
                    <td>
                        <?if ($row['proceed']=="1") {?>
                            <a href="../test/upload/<?=$row['out_file'];?>"><?=$row['out_file'];?></a>
                            <button type="button" class="playmusic btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-music"></span>
                            </button>
                        <?}?>
                    </td>
                    <td><?=$row['delay'];?></td>
                    <td><?=$row['times'];?></td>
                    <td><?=$row['start'];?></td>
                    <td><?=$row['addtime'];?></td>
                    <td><?=$row['proceed'];?></td>
                    <td><!--<a class="deleteone <?=$row['id'];?>">X</a>-->
                       <button type="button" class="deleteone <?=$row['id'];?> btn btn-default btn-xs">
                       <span class="glyphicon glyphicon-remove"></span>
                       </button>
                    </td>
                </tr>
            <? }
        }?>

        </tbody>
    </table>
    
<? } else { ?>
    <div class="page_content"> 
        <form role="form" method="post" action="admlogin">
            <div class="form-group  col-xs-5">
                <input type="password" class="form-control" id="admpwd" name="admpwd" placeholder="Enter password">
            </div>
            <div class="row">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
    </div>
<? } ?>