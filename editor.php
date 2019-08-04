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

    .login_page{
        margin-top:5%;
        margin-left:10%;
        display:none;
    }

    .reg_page{
        margin-top:5%;
        margin-left: 10%;
        display:none;
    }
</style>

<script>
    function login_fun(){
        var x = document.getElementById("login_page");
        var y = document.getElementById("reg_page");
        if(x.style.display=="block"){
            x.style.display="none";
        }
        else{
            x.style.display="block";
            y.style.display="none";
        }
        console.log(x.style.display);   
    }

    function reg(){
        var x = document.getElementById("reg_page");
        var y = document.getElementById("login_page");
        if(x.style.display=="block"){
            x.style.display="none";
        }
        else{
            x.style.display="block";
            y.style.display="none";
        }
        console.log(x.style.display); 

    }
</script>

</head>


<body>

<div id="login">
    <span onclick="login_fun()">login</span>&nbsp&nbsp&nbsp
    <span onclick="reg()">Register</span>
</div>

<div class = "login_page" id = "login_page">
    <form action="login.php" method = "POST">
        Username : <input type="text" name="username"></input><br><br>
        Password : <input type="password" name="pass"></input><br><br>
        <input type="submit" name="submit"><br><br>
    </form>
</div>

<div class= "reg_page" id="reg_page">
    <form action="reg.php" method="POST">
        Username : <input type="text" name="username"></input><br><br>
        Email : <input type="text" name="email"></input><br><br>
        Password : <input type="password" name="pass"></input><br><br>
        <input type="submit" name="submit"><br><br>
    </form>
</div>


<form id="form">
	<select id="language" name="language" onchange="languageChange()">
		<option value="C" selected="selected">C</option>
		<option value="c_cpp">C++14</option>
		<option value="java">Java</option>
		<option value="python">Python</option>
	</select>
	<div type="text" id="editor" name="div_code"></div>
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
        editor.getSession().on("change", function () {
        input.val(editor.getSession().getValue());
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
        console.log(values);

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