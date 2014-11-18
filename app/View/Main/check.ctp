   <script>
        function startRefresh() {
            setTimeout(startRefresh,5000);
            $.get('ajax', function(data) {
                $('#reztable').html(data);    
            });
        }


        $(function() {
            startRefresh();
            $( "#checkstatus" ).click(function() {
             // alert( "Handler for .click() called." );
              //get request
              $.get( "ajax", function( data ) {
            // $( ".result" ).html( data );
          alert( data);
        });

              return false;
            });

            $(document).on('click', ".playmusic", function() {
                var musicurl = $(this).prev().attr("href");
                //alert(musicurl);
                $("#audplayer").html("<audio src='"+musicurl+"' controls autoplay></audio>");
            });
        });
    </script> 
    <div class="page_content">

        <? if($secret) { ?>
            <div class="starter-template">
                    <h1>Registration complete!</h1>
                    <p class="lead">login link: http://tagmybeats.com/login?id=<?=$secret;?></p>
            </div>
        <? } ?>
        <div id="audplayer"><!-- <audio src="<?=$row[2];?>" controls></audio>--> </div>
    </div>
    <table class="table" id="reztable">
        <thead>
            <tr>
                <th>main file</th>
                <th>tag file</th>
                <th>result file</th>
                <th>delay</th>
                <th>repeats</th>
                <th>start</th>
                <th>addtime</th>
                <th>proceed</th>
            </tr>
        </thead>
        <tbody>
            <? foreach($tasks as $row) { ?>
                <tr>
                    <td>
                        <a href="../test/<?=$row['Task']['mainfile'];?>"><?=$row['Task']['mainfile_name'];?></a>
                    </td>
                    <td><a href="../test/<?=$row['Task']['tagfile'];?>"><?=$row['Task']['tagfile_name'];?></a></td>
                    <td>
                    <?if ($row['Task']['proceed']=="1") {?>
                    <a href="../test/upload/<?=$row['Task']['out_file'];?>"><?=$row['Task']['out_file'];?></a>
                    <?}?>
                    </td>
                    <td><?=$row['Task']['delay'];?></td>
                    <td><?=$row['Task']['times'];?></td>
                    <td><?=$row['Task']['start'];?></td>
                    <td><?=$row['Task']['addtime'];?></td>
                    <td><?=$row['Task']['proceed'];?></td>
                </tr>
            <? }?>
        </tbody>
    </table>
