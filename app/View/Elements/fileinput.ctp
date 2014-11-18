    <label for="<?php echo $id;?>">Main file</label>
    <div class="fakebtn">Choose your File</div>
    <input type="file" class="customFile" id="<?php echo $id;?>" name="<?php echo $id;?>" data-ext="<?php echo implode(',',$ext);?>">
    <p class="help-block">only .<?php echo implode(' .',$ext)?></p>
    <div class="fileName"></div>
