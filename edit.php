<?php
session_start();
$username = $_SESSION['username'];
$code_name = $_GET['codename'];
$language = $_GET['language'];
$ex = "";
if($language=="C")	$ex = ".c";
if($language=="c_cpp")	$ex = ".cpp";
if($language=="python")	$ex = ".py";
if($language=="java")	$ex = ".java";
$path = "c:\\xampp\htdocs\Dev-Helper\users\\".$username."\\".$code_name.$ex;
$o_c = "";
$f_c = fopen($path,"r");
$o_c = fread($f_c, filesize($path));
fclose($f_c);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>CODE ADIUTOR</title>
<style type="text/css" media="screen">
    #editor { 
		margin-top:10px;
		height:800px;
		width:1300px;
        font-size: 20px;
    }
</style>

<script>
    function logout(){
        location.href="logout.php";
    }
    function validateSaveForm(){
        var x = document.forms["myform"]["code"].value;
        console.log(x);
        if(x==""){
            alert("empty_editor");
            return false;
        }
        else{
            document.getElementById("language_s").value=document.getElementById("language").value;
            alert(document.getElementById("language_s").value);
            return true;
        }    
    }

    function saveshow(){
        var x = document.getElementById('savesub').style.visibility;
        var y = document.getElementById('savename').style.visibility;
        console.log(x,y);
        if(x=="hidden"){
            document.getElementById('savesub').style.visibility = "visible";
            document.getElementById('savename').style.visibility = "visible";
        }
        else{
            document.getElementById('savesub').style.visibility = "hidden";
            document.getElementById('savename').style.visibility = "hidden";
        }
    }
</script>

</head>


<body>
<div>
    <span>
        <a href='profile.php'><?php echo "$username"; ?></a>
    </span>&nbsp&nbsp&nbsp
    <span onclick="logout()">LOGOUT</span>&nbsp&nbsp&nbsp
    <span onclick="saveshow()">SAVE</span>
    
    <form action="save.php" name="myform" method="POST" onsubmit="return validateSaveForm()">
        <input hidden type="text" name="language" id="language_s"></input>
        <textarea hidden id="code_s" name="code"></textarea>
        <input type='text' name='code_name' id='savename' style="visibility:hidden"></input>
        <input type='submit' id="savesub" name='save' style="visibility:hidden"></input>
    </form>


</div>


<form id="form">
	<select id="language" name="language" onchange="languageChange()">
		<option value="C" selected="selected">C</option>
		<option value="c_cpp">C++14</option>
		<option value="java">Java</option>
		<option value="python">Python</option>
	</select>
	<div type="text" id="editor" name="div_code"><?php echo $o_c;?></div>
	<textarea hidden id="code" name="code"></textarea>
	INPUT : 
	<div class="input">
		<textarea name="input" id = "in" rows="10" cols="50"></textarea>
	</div>
	<input type="submit" id="but" name="run"></button>
</form>

<script src="ace-builds-master/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/c_cpp");
    editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: true,
        autoScrollEditorIntoView: true
    });

    var input = $('#code');
    var input_s = $('#code_s');
        editor.getSession().on("change", function () {
        input.val(editor.getSession().getValue());
        input_s.val(editor.getSession().getValue());
    });

    editor.commands.addCommand({
        name: "showKeyboardShortcuts",
        bindKey: {win: "Ctrl-Alt-h", mac: "Command-Alt-h"},
        exec: function(editor) {
            ace.config.loadModule("ace/ext/keybinding_menu", function(module) {
                module.init(editor);
                editor.showKeyboardShortcuts()
            })
        }
    })
    function languageChange(){
        var s = document.getElementById("language").value;
        s = "ace/mode/"+s;
        editor.session.setMode(s);
        editor.setValue("");
    }
	
	$('#form').submit(function(event){
        var xhr;
        // alert(input.val());
        event.preventDefault();
        $("#out").html('loading...');
        var values = $(this).serialize();
        xhr = $.ajax({
            url : "compile.php",
            type : "POST",
            data : values
        });

        xhr.done(function (response, textStatus, jqXHR){

            // Show successfully for submit message
            $("#out").html(response);
        });

        xhr.fail(function (){

            // Show error
            $("#result").html('There is error while submit');
        });


    });
	
	

</script>
OUTPUT : <br>
<textarea id="out" rows="10" cols="50"></textarea>
</body>
</html>