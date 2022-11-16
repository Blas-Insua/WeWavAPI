<?php
/* Smarty version 4.2.1, created on 2022-11-12 03:31:28
  from 'D:\Programs\XAMPP\htdocs\WeWavRest\templates\tracks.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_636f058021c878_08751666',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04fff1db44c9dd627607b2aa89440fe6f849e23d' => 
    array (
      0 => 'D:\\Programs\\XAMPP\\htdocs\\WeWavRest\\templates\\tracks.tpl',
      1 => 1668220286,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_636f058021c878_08751666 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="tracksList">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tracks']->value, 'track');
$_smarty_tpl->tpl_vars['track']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['track']->value) {
$_smarty_tpl->tpl_vars['track']->do_else = false;
?>
        <div class="file">
            <div class="fileTitle">
                <p><a href='about/<?php echo $_smarty_tpl->tpl_vars['track']->value->user_name;?>
'><?php echo $_smarty_tpl->tpl_vars['track']->value->user_name;?>
</a></p>
                <p><?php echo $_smarty_tpl->tpl_vars['track']->value->name;?>
</p>
            </div>
            
                <?php if ($_smarty_tpl->tpl_vars['track']->value->photo_dir != null) {?><div class="filePhoto hidden"><img src="<?php echo $_smarty_tpl->tpl_vars['track']->value->photo_dir;?>
"></img></div><?php } else { ?><span></span><?php }?>
            
            <div class="fileInfo hidden">
                <?php if ($_SESSION['loggedin'] == true && $_smarty_tpl->tpl_vars['track']->value->userName == $_SESSION['name']) {?>
                    <form action="editFile/<?php echo $_smarty_tpl->tpl_vars['track']->value->id;?>
" method="post">
                        <button type="submit" class="editFile" title="Edit track" name="editFile">edit</button>
                        <div class="trackForm">
                            <label for="name">Track name:</label>
                                <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['track']->value->name;?>
" required></input><br>
                            <label for="genre">Genre:</label>
                                <select name="genre" required>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['genres']->value, 'genre');
$_smarty_tpl->tpl_vars['genre']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['genre']->value) {
$_smarty_tpl->tpl_vars['genre']->do_else = false;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['genre']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['track']->value->genre_id == $_smarty_tpl->tpl_vars['genre']->value->id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['genre']->value->genre;?>
</option>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select><br>
                            <label for="date">Date:</label>
                                <input type="date" name="date" <?php if ($_smarty_tpl->tpl_vars['track']->value->date) {?>value="<?php echo $_smarty_tpl->tpl_vars['track']->value->date;?>
"<?php }?>></input><br> 
                        </div>   
                        <a class="deleteFile" href="deleteFile/<?php echo $_smarty_tpl->tpl_vars['track']->value->id;?>
/" title="Delete track">del</a>                    
                    </form>                    
                <?php } else { ?>
                    <p><?php echo $_smarty_tpl->tpl_vars['track']->value->name;?>
</p>
                    <p>Genre: <a href="genres/<?php echo $_smarty_tpl->tpl_vars['track']->value->genre;?>
/"><?php echo $_smarty_tpl->tpl_vars['track']->value->genre;?>
</a></p>
                    <p>Date: <?php echo $_smarty_tpl->tpl_vars['track']->value->date;?>
</p>
                <?php }?>
            </div>
            <audio controls src="" alt="" type="audio/wav"></audio>
        </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div><?php }
}
