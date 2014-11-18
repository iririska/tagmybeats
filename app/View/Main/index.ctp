<div class="page_content"> 
    <div class="page_centermod clearfix">
            <div class="left_centermod">
                <?php echo $this->Html->image('img1.png', array('alt' => '', 'border' => '0'));?>
            </div>
            <div class="right_centermod">
                <h4>"ONE GOOD</h4>
                <h4>THING ABOUT</h4>
                <h4 class="color_1">MUSIC</h4>
                <h4>WHEN IT HITS YOU,</h4>
                <h4>YOU FEEL NO PAIN."</h4>
                <h6>BOB MARLEY</h6>
            </div>
        </div>
        <h2>Upload your files</h2>
        <form role="form" class="black_form" method="post" action="check" id="PostAddForm" enctype="multipart/form-data">
            <input type='hidden' name='posted' value='posted'>

            <div class="clearfix">
                <div class="inputFile clearfix float_left50">
                    <?php echo $this->element('fileinput',array('id'=>'mainfile','ext'=>array('wav','mp3')));?>
                </div>
                <div class="inputFile clearfix float_right50">
                    <?php echo $this->element('fileinput',array('id'=>'tagfile','ext'=>array('wav','mp3')));?>
                </div>
            </div>

            <div>
                <label for="tagtext">OR text</label>
                <input type="text" class="form-control" name="tagtext" id="tagtext" size="2" placeholder="Enter text">
            </div>

            <div>
                <label for="delay">delay between tags</label>
                <input type="number" min="0" step="1" class="form-control" id="delay" name="delay" size="2" placeholder="Enter digit">
            </div>

            <div>
                <label for="repeat">* times repeat</label>
                <input type="number" min="0" step="1" class="form-control" name="repeat" id="repeat" size="2" placeholder="Enter digit">
            </div>

            <div>
                <label for="start">Start a tag with * second</label>
                <input type="number" min="0" step="1" class="form-control" name="start" id="start" size="2" placeholder="Enter digit">
            </div>
            
            <? if ($rez == False) { ?>
                <div>
                    <label for="start">Email for registration</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                </div>
            <? } ?>

            <button type="submit" id="sendbutton" class="fakebtn" style="margin: 40px auto;display: block;">Submit</button>
        </form>
</div>

