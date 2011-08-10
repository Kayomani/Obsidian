<?php /* Smarty version Smarty3-RC3, created on 2011-08-10 21:32:28
         compiled from "C:/xampp/htdocs/Obsidian/skins/default/master.intranet.htm" */ ?>
<?php /*%%SmartyHeaderCode:155104e42dccc4ea9b4-35517429%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf1665fab9186d4fe3647bbfa4c917bd7944b065' => 
    array (
      0 => 'C:/xampp/htdocs/Obsidian/skins/default/master.intranet.htm',
      1 => 1313004178,
    ),
  ),
  'nocache_hash' => '155104e42dccc4ea9b4-35517429',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <link rel = "stylesheet" href = "<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
css/blueprint/screen.css" type = "text/css" media = "screen, projection"/>
        <link rel = "stylesheet" href = "<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
css/blueprint/print.css" type = "text/css" media = "print"/>
        <!--[if lt IE 8]>
        <link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection">
        <![endif]-->
        <link rel = "stylesheet" href = "<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
css/blueprint/plugins/fancy-type/screen.css" type = "text/css" media = "screen, projection"/>
        <link rel = "stylesheet" href = "<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
css/blueprint/plugins/sprites/sprite.css" type = "text/css" media = "screen, projection"/>
       
        <link rel = "stylesheet" href = "<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
css/menu.css" type = "text/css" media = "screen, projection"/>
          <link rel = "stylesheet" href = "<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
css/niftyCorners.css" type = "text/css" media = "screen, projection"/>
        
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
js/jquery-1.4.2.js"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
js/menu.js"></script>
         <STYLE type="text/css">
          BODY { background-image:url("<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
images/bg.gif") }
          #outer { background: #FFFFFF;padding:50px;border:medium double;padding-top:20px }
    </STYLE>
        <script type="text/javascript" src="js/niftycube.js"></script>
   <script type="text/javascript">
window.onload=function(){
Nifty("div.ttelement","big");
}
</script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
libs/ckeditor/ckeditor.js"></script>



 <link rel = "stylesheet" href = "<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
css/intranet.css" type = "text/css" media = "screen, projection"/>
 <link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
css/muffin.css" type="text/css" media="all" />
    </head>
    <body>
    
        <div id="outer" class="container">
            <h1><?php echo $_smarty_tpl->getVariable('lan')->value->name;?>
 Intranet</h1>
           
            <div id="menu">
    <ul class="menu">
    <li><a href="<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
"><span>Home</span></a></li>
    <li><a href="<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
?page=timetable"><span>Timetable</span></a>

	</li>
    <li><a href="<?php echo $_smarty_tpl->getVariable('webPath')->value;?>
?page=seating"><span>Seating</span></a>

	</li>
	<li><a href="?page=serverlist"><span>Server
	list</span></a></li>
	<li><a href="?page=fileshare"><span>File Sharing</span></a>

	</li>
	
	<li><a href="?page=userlist"><span>User
	List</span></a></li>
       <?php if (CheckPermission("admin","view admin menu")){?>
	<li><a href="?page=adminmenu" ><span>Admin</span></a></li>
	<?php }?>

    </ul>
</div>
            <hr/>
            <div class = "span-6 colborder">
           <?php $_template = new Smarty_Internal_Template('string:'.$_smarty_tpl->getVariable('_login')->value, $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->getRenderedTemplate(); ?>
           <?php $_template = new Smarty_Internal_Template('string:'.$_smarty_tpl->getVariable('_remaining')->value, $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->getRenderedTemplate(); ?>
           <?php $_template = new Smarty_Internal_Template('string:'.$_smarty_tpl->getVariable('_yourevents')->value, $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->getRenderedTemplate(); ?>
           
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div>
             <div class = "span-20 last ">
             <?php echo $_smarty_tpl->getVariable('master_errors')->value;?>

                 <?php $_template = new Smarty_Internal_Template('string:'.$_smarty_tpl->getVariable('master_page')->value, $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->getRenderedTemplate(); ?>
            </div>
        </div>
       <div style="text-align:center;color:lightGrey;"><strong>Lannage</strong> :: LAN party manager by Kayomani.  Your page created in %%REPLACE%%</div>
    </body>
</html>

