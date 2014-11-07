    <thead>
        <tr>
            <th>Main file</th>
            <th>Tag file</th>
            <th>Result file</th>
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
                <button type="button" class="playmusic btn btn-default btn-xs">
                <span class="glyphicon glyphicon-music"></span>
                </button>
            </td>
            <td><a href="../test/<?=$row['Task']['tagfile'];?>"><?=$row['Task']['tagfile_name'];?></a>
                <button type="button" class="playmusic btn btn-default btn-xs">
                <span class="glyphicon glyphicon-music"></span>
                </button>
            </td>
            <td>
            <?if ($row['Task']['proceed']=="1") {?>
            <a href="../test/upload/<?=$row['Task']['out_file'];?>"><?=$row['Task']['out_file'];?></a>
                <button type="button" class="playmusic btn btn-default btn-xs">
                <span class="glyphicon glyphicon-music"></span>
                </button>
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