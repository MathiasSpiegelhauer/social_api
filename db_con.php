<?
function db_con()
{
    $con = mysqli_connect("mysql104.unoeuro.com","mathiasspiegelhauer_dk","rEgwkhanzDGf","mathiasspiegelhauer_dk_db_social");

    /* check connection */
    if (mysqli_connect_errno()) {

        printf(mysqli_connect_error()."  <h1> oplever driftsproblemer p&aring; en af vores servere - men forventer at problemet er l&oslash;st indenfor f&aring; minutter.</h1> Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    mysqli_set_charset($con,"utf8");
    return $con;
}

function fetch_assoc($query="", $params=[]){
    $con = db_con();
    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $stmt = $con->prepare($query);
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
    } catch (Exception $e){
    }
    return $result;
}

function fetch_all($query="", $params=[]){
    $con = db_con();
    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $stmt = $con->prepare($query);
        if (count($params)) {
            $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        }
        $stmt->execute();

        $result = $stmt->get_result();
        $statistic = [];
        while ($data = $result->fetch_assoc()) {
            $statistic[] = $data;
        }
    } catch (Exception $e){
    }
    return $statistic;
}

function update($query="", $params=[]){
    $con = db_con();
    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $stmt = $con->prepare($query);
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
    } catch (Exception $e){
    }
}

function insert($query="", $params=[]){
    $con = db_con();
    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


    try {
        $stmt = $con->prepare($query);
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
    } catch (Exception $e){
    }
    return $con->insert_id;
}

function delete($query="", $params=[]){
    $con = db_con();
    //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $stmt = $con->prepare($query);
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
    } catch (Exception $e){
    }
}

?>