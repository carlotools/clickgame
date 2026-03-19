<?php
session_start();

// --- MySQL Config ---
$host='localhost';
$user='DB_USER';
$pass='DB_PASS';
$db='DB_NAME';
$link = new mysqli($host,$user,$pass,$db);
if($link->connect_error) die("DB Connect Error");
$link->set_charset('utf8');

// --- Handle AJAX score submission ---
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action']) && $_POST['action']=='submit_score'){
    $name = substr(preg_replace("/[^a-zA-Z0-9]/","",$_POST['name'] ?? ''),0,30);
    $score = intval($_POST['score'] ?? 0);
    $message = substr(preg_replace("/[^a-zA-Z0-9 .!?]/","",$_POST['message'] ?? ''),0,150);

    if($name && $score>=0){
        // Check previous
        $stmt = $link->prepare("SELECT score,attempts FROM tile_game_rank WHERE name=?");
        $stmt->bind_param("s",$name);
        $stmt->execute();
        $stmt->bind_result($prevScore,$attempts);
        $stmt->fetch();
        $stmt->close();

        if(isset($prevScore)){
            $attempts+=1;
            if($score>$prevScore){
                $upd=$link->prepare("UPDATE tile_game_rank SET score=?,time=NOW(),message=?,attempts=? WHERE name=?");
                $upd->bind_param("issi",$score,$message,$attempts,$name);
                $upd->execute();
                $upd->close();
            }else{
                $upd=$link->prepare("UPDATE tile_game_rank SET attempts=? WHERE name=?");
                $upd->bind_param("is",$attempts,$name);
                $upd->execute();
                $upd->close();
            }
        } else {
            $attempts=1;
            $ins=$link->prepare("INSERT INTO tile_game_rank (score,name,time,attempts,message) VALUES (?,?,NOW(),?,?)");
            $ins->bind_param("isis",$score,$name,$attempts,$message);
            $ins->execute();
            $ins->close();
        }
        echo json_encode(['success'=>true]);
    } else { echo json_encode(['error'=>'Invalid input']); }
    exit;
}

// --- Fetch leaderboard ---
$leaderboard=[];
$res = $link->query("SELECT name,score,attempts,message FROM tile_game_rank ORDER BY score DESC LIMIT 10");
while($row=$res->fetch_assoc()) $leaderboard[]=$row;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>Bottom Tap Tile Game</title>
<style>
body{margin:0;font-family:sans-serif;background:#fff;overflow:hidden;}
#gameArea{position:relative;width:100%;height:100vh;background:#eee;}
.tile{position:absolute;width:60px;height:60px;background:#3498db;border-radius:8px;text-align:center;line-height:60px;color:#fff;font-weight:bold;font-size:1.2em;}
#scoreboard{position:absolute;top:0;left:0;width:100%;height:50px;background:#fff;display:flex;justify-content:space-around;align-items:center;font-size:1.2em;z-index:1000;}
button{padding:.5em 1em;margin:2px;font-size:1em;}
#leaderboard{position:absolute;top:60px;right:10px;background:#fff;border:1px solid #ccc;padding:10px;max-width:200px;z-index:1000;}
</style>
</head>
<body>
<div id="scoreboard">
<div>Score: <span id="score">0</span></div>
<div>CPS: <span id="cps">0</span></div>
<button onclick="startGame()">Start</button>
<button onclick="location.reload()">Home</button>
</div>

<div id="leaderboard">
<h4>Leaderboard</h4>
<ul>
<?php foreach($leaderboard as $row): ?>
<li><?php echo htmlspecialchars($row['name']).": ".$row['score']; ?></li>
<?php endforeach; ?>
</ul>
</div>

<div id="gameArea"></div>

<script>
let gameArea=document.getElementById('gameArea');
let scoreEl=document.getElementById('score');
let cpsEl=document.getElementById('cps');
let score=0,clicks=0,startTime,tiles=[],gameInterval;

function startGame(){
    score=0; clicks=0;
    tiles=[];
    scoreEl.textContent=0;
    cpsEl.textContent=0;
    gameArea.innerHTML='';
    spawnTiles(5);
    startTime=Date.now();
    gameInterval=setInterval(updateGame,16);
}

function spawnTiles(n){
    for(let i=0;i<n;i++){
        let t=document.createElement('div');
        t.className='tile';
        t.style.bottom=Math.floor(Math.random()*50)+'px';
        t.style.left=Math.floor(Math.random()*(window.innerWidth-60))+'px';
        t.textContent='Tap';
        t.addEventListener('click',tileClicked);
        gameArea.appendChild(t);
        tiles.push(t);
    }
}

function tileClicked(e){
    let tile=e.target;
    // Only allow bottom-most first
    let minBottom=Math.min(...tiles.map(x=>parseFloat(x.style.bottom)));
    if(parseFloat(tile.style.bottom) > minBottom+1) return; // can't tap upper tiles first
    tiles=tiles.filter(x=>x!==tile);
    tile.remove();
    score+=10;
    clicks+=1;
    scoreEl.textContent=score;
}

function updateGame(){
    tiles.forEach(t=>{
        t.style.bottom=(parseFloat(t.style.bottom)+0.5)+'px';
    });
    let elapsed=(Date.now()-startTime)/1000;
    cpsEl.textContent=(clicks/elapsed).toFixed(1);
    // Spawn new tile periodically
    if(Math.random()<0.02) spawnTiles(1);
    // End game at 25s
    if(elapsed>25){ endGame(); }
}

function endGame(){
    clearInterval(gameInterval);
    alert('Game Over! Score: '+score);
    let name=prompt("Enter your name","");
    if(name){
        fetch('',{
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'action=submit_score&name='+encodeURIComponent(name)+'&score='+score
        }).then(r=>r.json()).then(d=>{
            if(d.success) alert('Score submitted!');
            location.reload();
        });
    }
}
</script>
</body>
</html>
