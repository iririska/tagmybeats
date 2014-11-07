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
foreach($usr['Task'] as $row)
{
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
            <td>
               <button type="button" class="deleteone <?=$row['id'];?> btn btn-default btn-xs">
                <span class="glyphicon glyphicon-remove"></span>
                </button>
            </td>
        </tr>
<? }
}
?>

 </tbody>