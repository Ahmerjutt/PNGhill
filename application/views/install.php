<? phpinfo(); ?>
<!DOCTYPE html>
<html>
<head>
<style> 
*{
  font-family: sans-serif;
}
input {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid green;
  border-radius: 4px;
}
</style>
</head>
<body>
<h1 style="text-align:center">Installation</h1>
<form style="max-width:1280px;padding:20px;margin:auto;" action="<?=base_url('Welcome/config')?>">
  <h2>Site Settings</h2>
  <input placeholder="Site Title" type="text" name="siteTitle">
  <input placeholder="admin Email" type="text" name="adminEmail">
  <input placeholder="Password" type="text" name="adminPass">
  <h2>Databse Settings</h2>
  <input placeholder="DB Host" type="text" name="DBHost">
  <input placeholder="DB Name" type="text" name="DBName">
  <input placeholder="DB Username" type="text" name="DBUsername">
  <input placeholder="DB Password" type="text" name="DBPass">
  <input type="submit" value="Install" style="background:green;color:white;cursor:pointer">
</form>

</body>
</html>
