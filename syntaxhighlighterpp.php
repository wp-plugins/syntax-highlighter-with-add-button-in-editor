<?php
/*
Plugin Name: 代码高亮编辑器增强插件
Plugin URI: http://leo108.com/?p=587
Description: 支持Bash/shell, C#, C++, CSS, Delphi, Diff, Groovy, JavaScript, Java, Perl, PHP, Plain Text, Python, Ruby, Scala, SQL, Visual Basic and XML等语言，并在编辑器下方增加一个代码输入框，直接将相关代码贴入编辑器中。 
Version: 2.0
Author: leo108
Author URI: http://leo108.com/
*/

function highlighter_header() {
	$current_path = get_option('siteurl') .'/wp-content/plugins/' . basename(dirname(__FILE__)) .'/';
	?>
	<link type="text/css" rel="stylesheet" href="<?php echo $current_path; ?>styles/shCore.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo $current_path; ?>styles/shThemeDefault.css" />
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shCore.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushBash.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushCpp.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushCSharp.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushCss.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushDelphi.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushDiff.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushGroovy.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushJava.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushJScript.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushPerl.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushPhp.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushPython.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushRuby.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushScala.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushSql.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushVb.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shBrushXml.js"></script>
	<script type="text/javascript">		
		SyntaxHighlighter.config.clipboardSwf = '<?php echo $current_path; ?>scripts/clipboard.swf';
		SyntaxHighlighter.all();
	</script>
	<?php
}
function codebox_init(){
	echo '<div id="codebox" class="meta-box-sortables ui-sortable" style="position: relative;"><div class="postbox">';
	echo '<div class="handlediv" title="Click to toggle">';
	echo '</div>';
	echo '<h3 class="hndle"><span>代码高亮</span></h3>';
	echo '<div class="inside">';
	?>
	Language:
	<select id="language">
	<option value="bash">Bash</option>
	<option value="c">C</option>
	<option value="cpp">C++</option>
	<option value="csharp">C#</option>
	<option value="css">CSS</option>
	<option value="delphi">Delphi</option>
	<option value="diff">Diff</option>
	<option value="erl">Erlang</option>
	<option value="groovy">Groovy</option>
	<option value="html">HTML</option>
	<option value="java">Java</option>
	<option value="javascript">Javascript</option>
	<option value="perl">Perl</option>
	<option value="php">PHP</option>
    <option value="ps">PowerShell</option>
	<option value="python">Python</option>
	<option value="ruby">Ruby</option>
	<option value="sql">SQL</option>
	<option value="vb">VisualBasic</option>
	<option value="vb">VB.NET</option>
	<option value="xml">XML</option>
</select>
<br>
Code:<br><textarea id="code" rows="8" cols="70" style="width:97%;"></textarea><br>
<input type="button" value="OK" onclick="javascript:settext();">

<script>
function settext()
{ 
	var str='<pre class="brush:';
	var lang=document.getElementById("language").value;
	var code=document.getElementById("code").value;
	str=str+lang;
	str=str+'">'
	str=str+filter(code)+"</pre>"
	var win = window.dialogArguments || opener || parent || top;
	win.send_to_editor(str);
	document.getElementById("code").value="";
}
function filter (str) {
	str = str.replace(/&/g, '&amp;');
	str = str.replace(/</g, '&lt;');
	str = str.replace(/>/g, '&gt;');
	str = str.replace(/'/g, '&#39;');
	str = str.replace(/"/g, '&quot;');
	str = str.replace(/\|/g, '&brvbar;');
	return str;
}
</script>
	<?php
	echo '</div></div></div>';
	echo '<script>document.getElementById("postdivrich").appendChild(document.getElementById("codebox"));</script>';
}
add_action('dbx_post_sidebar','codebox_init');
add_action('wp_head','highlighter_header');
?>
