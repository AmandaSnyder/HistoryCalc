<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Calculator</title>
  <meta name="description" content="calculator app">
  <meta name="author" content="Amanda Snyder">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/paintcoat.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

  
  <!-- Scripts
  ----------------------------------------- -->
  <script src="js/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="js/display.js"></script>
  <script src="js/logic.js"></script>
  
</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <?php
    require "config.php";
    class myException extends Exception {}
    try {
        $dbaccess = new PDO($sinf, $un, $pw); //server info, username, password
        $dbaccess->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $entrytime = date("Y-m-d H:i:s");
        $query = $dbaccess->prepare("insert into visitors (visitTime) values ('$entrytime')");
        try {
          $query->execute();  
        }
        catch(MyException $err2) {
            echo "Whoops! Query error! " . $err2->getMessage();
        }
    }
    catch(PDOException $err) {
        echo "Whoops! " . $err->getMessage();
    }
    ?>
  <!--<nav>             //nav is not needed. was originally added in case of additional apps.
      <div class="container">
         <div class="row">
             <div class="two columns navLink">@</div>
             <div class="two columns navLink">@</div>
             <div class="two columns navLink">@</div>
             <div class="two columns navLink">@</div>
             <div class="two columns navLink">@</div>
             <div class="two columns navLink">@</div>
         </div>
      </div>
  </nav>-->
  <div class="container calc">
      <div class="row">
          <div class="three columns">
              Options: 
          </div>
          <button id="clear" class="two columns">
              Clear
          </button>
 
      </div>
      <div class="row">
          <div id="numericIO" class="nine columns calc">ready</div> <!--display buttons pressed -->
          <div id="answer" class="two columns calc">ready</div> <!--display answer/output -->
      </div>
      <!-- below: input keys, in layout ft. skeleton css -->
      <div class="row">
        <div id="zero" class="one column numButton">
          0
        </div>
        <div id="one" class="one column numButton">
          1
        </div>
        <div class="nine columns">
          
        </div>
        
      </div>
      <div class="row">
        <div id="two" class="one column numButton">
          2
        </div>
        <div id="three" class="one column numButton">
          3
        </div>
        <div id="add" class="one column offset-by-one numButton">
          +
        </div>
        <div id="subtract" class="one column offset-by-one numButton">
          -
        </div>
        <div id="multiply" class="one column offset-by-one numButton">
          x
        </div>
        <div id="decimal" class="one column offset-by-one numButton">
          .
        </div>
        
      </div>
      <div class="row">
        <div id="four" class="one column numButton">
          4
        </div>
        <div id="five" class="one column numButton">
          5
        </div>
        <div class="nine columns">
          
        </div>
        
      </div>
      <div class="row">
        <div id="six" class="one column numButton">
          6
        </div>
        <div id="seven" class="one column numButton">
          7
        </div>
        <div id="divide" class="one column offset-by-one numButton">
          /
        </div>
        <div id="modulus" class="one column offset-by-one numButton">
          %
        </div>
        <div id="powRaise" class="one column offset-by-one numButton">
          ^
        </div>
        
      </div>
      <div class="row">
        <div id="eight" class="one column numButton">
          8
        </div>
        <div id="nine" class="one column numButton">
          9
        </div>
        <div class="eight columns">
          
        </div>
      
      </div>
      <div class="row">
          <button id="runCalc" class="one column offset-by-two button-primary">Run</button>
      </div>
  </div>
  
<script>
        

        
        
        //global variable declarations
        var inp = "";
        var clear = document.getElementById("clear");
        var zero = document.getElementById("zero");
        var one = document.getElementById("one");
        var two = document.getElementById("two");
        var three = document.getElementById("three");
        var four = document.getElementById("four");
        var five = document.getElementById("five");
        var six = document.getElementById("six");
        var seven = document.getElementById("seven");
        var eight = document.getElementById("eight");
        var nine = document.getElementById("nine");
        var add = document.getElementById("add");
        var subtract = document.getElementById("subtract");
        var divide = document.getElementById("divide");
        var multiply = document.getElementById("multiply");
        var power = document.getElementById("powRaise");
        var decimal = document.getElementById("decimal");
        var modulus = document.getElementById("modulus"); //implement later
        var runCalc = document.getElementById("runCalc");
        var answer = document.getElementById("answer");
        
        //var wip = document.getElementsByClassName("wip");

        //event listeners
        clear.addEventListener("click", clearInput);
        clear.addEventListener("click", updateInput);
        zero.addEventListener("click",function(){ addInput("0");});
        zero.addEventListener("click", updateInput);
        one.addEventListener("click",function(){ addInput("1");});;
        one.addEventListener("click", updateInput);
        two.addEventListener("click",function(){ addInput("2");});
        two.addEventListener("click", updateInput);
        three.addEventListener("click",function(){ addInput("3");});
        three.addEventListener("click", updateInput);
        four.addEventListener("click",function(){ addInput("4");});
        four.addEventListener("click", updateInput);
        five.addEventListener("click",function(){ addInput("5");});
        five.addEventListener("click", updateInput);
        six.addEventListener("click",function(){ addInput("6");});
        six.addEventListener("click", updateInput);
        seven.addEventListener("click",function(){ addInput("7");});
        seven.addEventListener("click", updateInput);
        eight.addEventListener("click",function(){ addInput("8");});
        eight.addEventListener("click", updateInput);
        nine.addEventListener("click",function(){ addInput("9");});
        nine.addEventListener("click", updateInput);
        add.addEventListener("click",function(){ addInput(" + ");});
        add.addEventListener("click", updateInput);
        subtract.addEventListener("click",function(){ addInput(" - ");});
        subtract.addEventListener("click", updateInput);
        multiply.addEventListener("click",function(){ addInput(" * ");});
        multiply.addEventListener("click", updateInput);
        divide.addEventListener("click",function(){ addInput(" / ");});
        divide.addEventListener("click", updateInput);
        power.addEventListener("click",function(){ addInput(" ** ");});
        power.addEventListener("click", updateInput);
        decimal.addEventListener("click",function(){ addInput(".");});
        decimal.addEventListener("click", updateInput);
        runCalc.addEventListener("click", processInput);
        
        
        //wip.addEventListener("focus", function() {wip.innerHTML = "unavailable";});
        
        //functions
        function clearInput() {
            inp = "";
            answer.innerHTML = "ready";
            document.getElementById("numericIO").innerHTML = "ready";
            //window.alert("Ready for fresh input!");
        };
        function addInput(c) {
        inp = inp + c;
        //window.alert(inp);
        };
        function updateInput() {
            document.getElementById("numericIO").innerHTML = inp;
        };
        function processInput() {
            
                    //turn inpPcs[lBound] to inpPcs[rBound] into string
                    //if final operator is "-" then remove all operators between it and the first one. else remove all operators after the first one
               //perhaps there's a better way to do this within the string itself with reg expressions? check into it
           var firstInd = inp.search(/\D/);
           firstInd += 1;
           var first = inp.charAt(firstInd);
           inp = inp.replace(/\D+ * [+*/]/g, first);
           
           answer.innerHTML = eval(inp);
           
            
        };
        
            //for each piece in inpArray, use .replace to clean off excess operators. Implement if keyboard input comes back
            
  </script>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
