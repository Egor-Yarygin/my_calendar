$id=$_GET['mess_id'];
$sql='SELECT * FROM tb_message WHERE tb_message.id="'.$id.'"';
$res=mysql_query($sql)or die(mysql_error());

while($row = mysql_fetch_array($res, MYSQL_ASSOC)){
 foreach ($row as $key => $val) {
  echo "<input type="text" name="$key" value="$val" />";
 }
}