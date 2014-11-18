<!DOCTYPE html>
<html>
    <head>
        
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <?php echo $this->Html->css('style');?>
        <?php echo $this->Html->script('jquery'); ?>
        <?php echo $this->Html->script('script'); ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
    </head>
    
    <body>
        <div class="site_structure">

            <?php echo $this->element('sitehead');?>
            
            <div class="site_page">
                 <?php echo $this->fetch('content'); ?>
            </div>
            
            <div class="hFooter"></div>
        </div>
        
        <div class="page_footer">
            <p>© 2014 by RAW MUSIC.</p>
        </div>

    </body>
</html>
