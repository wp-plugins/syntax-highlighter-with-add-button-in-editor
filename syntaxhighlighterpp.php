<?php
/*
Plugin Name: syntax-highlighter++
Plugin URI: http://leo108.com/?p=587
Description: 支持Bash/shell, C#, C++, CSS, Delphi, Diff, Groovy, JavaScript, Java, Perl, PHP, Plain Text, Python, Ruby, Scala, SQL, Visual Basic and XML等语言，并在编辑器下方增加一个代码输入框，直接将相关代码贴入编辑器中。 
Version: 2.1.0
Author: leo108
Author URI: http://leo108.com/
*/

function highlighter_footer() {
	$current_path = get_option('siteurl') .'/wp-content/plugins/' . basename(dirname(__FILE__)) .'/';
	?>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shCore.js"></script>
	<script type="text/javascript" src="<?php echo $current_path; ?>scripts/shAll.js"></script>
	<script type="text/javascript">		
		SyntaxHighlighter.config.clipboardSwf = '<?php echo $current_path; ?>scripts/clipboard.swf';
		SyntaxHighlighter.all();
	</script>
	<?php
}
function highlighter_head() {
	$current_path = get_option('siteurl') .'/wp-content/plugins/' . basename(dirname(__FILE__)) .'/';
	?>
	<link type="text/css" rel="stylesheet" href="<?php echo $current_path; ?>styles/shCore.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo $current_path; ?>styles/shThemeDefault.css" />
	<?php
}
function codebox_init(){
?>
<div id="codebox" class="meta-box-sortables ui-sortable" style="position: relative;"><div class="postbox">
<div class="handlediv" title="Click to toggle"></div>
<h3 class="hndle"><span>syntax highlighter ++</span></h3>
<div class="inside">
Language:
<select id="language">
	<option value="other">Other</option>
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
	str=str+'">';
	str=str+filter(code)+"</pre><p>&nbsp;</p>";
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
</div></div></div>
<script>document.getElementById("postdivrich").appendChild(document.getElementById("codebox"));</script>
<?php
}
add_action('dbx_post_sidebar','codebox_init');
add_action('wp_footer','highlighter_footer');
add_action('wp_head','highlighter_head');
?>
