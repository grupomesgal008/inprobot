<?php
class ModeloAgenda
{
    private $conn;
    private $atributos;
    private $gets;
    private $lastid;
    public function __construct()
    {
        header('Content-Type: text/html; charset=UTF-8');
        $this->atributos = [];
    }
    public function getAgendas()
    {
        // $this->select("GM_AGE", "", 0);
        // return $this->gets;
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (isset($_SESSION["codigo_usuario"])) {
            $usuario = $_SESSION["codigo_usuario"];
            $this->conectarse();
            $sql = "SELECT a.*,au.* FROM GM_AGE a, GM_AGE_USU au WHERE a.AGECOD = au.AGECOD AND au.USUCOD=$usuario ORDER BY 1";
            foreach ($this->conn->query($sql) as $res) {
                $this->gets[] = $res;
            }
            return $this->gets;
        } else {
            return 0;
        }
    }
    public function getMisTareas($tipo, $agenda)
    // para vista tareas
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (isset($_SESSION["codigo_usuario"])) {
            $usucde = $_SESSION["usucde"];
            $usuario = $_SESSION["codigo_usuario"];
            $sql = "SELECT t.*,
                (SELECT USUIMG FROM GM_USU WHERE USUCOD=t.TARCRE)'fotoCRE',
                (SELECT USUIMG FROM GM_USU WHERE USUCOD=t.TARASI)'fotoASI',
                (SELECT AGECOL FROM GM_AGE WHERE AGECOD=(SELECT TARCAG FROM GM_TAR WHERE TARCOD=t.TARCOD))'AGECOL',
                (SELECT NOTTIP FROM GM_NOT WHERE NOTCUS=$usuario AND t.TARCOD=NOTCTA AND NOTLEI=0 GROUP by NOTCTA)'NOTIFICACION' 
                FROM GM_TAR t,GM_USU u WHERE";
            if ($agenda != -1) {
                $sql .= " t.TARCAG=$agenda AND";
            }
            switch ($tipo) {
                case 0: //asignadas a mi o a mi departamento
                    if ($_SESSION["usures"] == 1) {
                        $sql .= " ((t.TARASI = u.USUCOD AND u.USUCOD=$usuario) OR (t.TARCDE=$usucde AND (t.TARTIP='EVE' OR t.TARTIP='PRO')))";
                    } else {
                        $sql .= " t.TARASI=$usuario";
                    }
                    break;
                case 1: //creadas por mi
                    $sql .= " t.TARCRE=$usuario";
                    break;
                case -1: //todas
                    if ($_SESSION["usures"] == 1) {
                        $sql .= " ((t.TARASI = u.USUCOD AND u.USUCOD=$usuario) OR (t.TARCDE=$usucde AND (t.TARTIP='EVE' OR t.TARTIP='PRO')) OR (t.TARCRE=$usuario))";
                    } else {
                        $sql .= " (t.TARCRE=$usuario OR t.TARASI=$usuario)";
                    }
                    break;
            }
            $sql .= " GROUP BY t.TARCOD ORDER BY NOTIFICACION DESC,t.TARINI,t.TAREST DESC";
            $this->conectarse();
            foreach ($this->conn->query($sql) as $res) {
                $this->gets[] = $res;
            }
            return $this->gets;
        } else {
            return 0;
        }
    }
    public function getTareas($fecha, $mensual)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $usuario = $_SESSION["codigo_usuario"];
        $mes = date((new DateTime($fecha))->format('m'));
        $ano = date((new DateTime($fecha))->format('Y'));
        $this->conectarse();
        if (!$mensual) {
            $date = " AND (((DATE_FORMAT(t.TARINI, '%c')=$mes AND DATE_FORMAT(t.TARINI, '%Y')=$ano) OR (DATE_FORMAT(t.TARFIN, '%c')=$mes AND DATE_FORMAT(t.TARFIN, '%Y')=$ano))";
            $dia = idate("d", strtotime((new DateTime($fecha))->format('Y-m-d')));
            $otro_mes = idate("m", strtotime((new DateTime($fecha))->format('Y-m-d')));
            $otro_ano = idate("Y", strtotime((new DateTime($fecha))->format('Y-m-d')));
            if ($dia < 7) {
                if ($otro_mes > 1) {
                    $otro_mes--;
                    $otro_mes = str_pad($otro_mes, 2, "0", STR_PAD_LEFT);
                } else {
                    $otro_mes = '12';
                    $otro_ano--;
                }
            } else  if ($dia > 25) {
                if ($otro_mes < 12) {
                    $otro_mes++;
                    $otro_mes = str_pad($otro_mes, 2, "0", STR_PAD_LEFT);
                } else {
                    $otro_mes = '01';
                    $otro_ano++;
                }
            }
            $date .= " OR ((DATE_FORMAT(t.TARINI, '%c')=$otro_mes AND DATE_FORMAT(t.TARINI, '%Y')=$otro_ano) OR (DATE_FORMAT(t.TARFIN, '%c')=$otro_mes AND DATE_FORMAT(t.TARFIN, '%Y')=$otro_ano))))";
        } else {
            $date = " AND ((DATE_FORMAT(t.TARINI, '%c')=$mes AND DATE_FORMAT(t.TARINI, '%Y')=$ano) OR (DATE_FORMAT(t.TARFIN, '%c')=$mes AND DATE_FORMAT(t.TARFIN, '%Y')=$ano)))";
        }

        if ($_SESSION["usures"] == 1) {
            $usucde = $_SESSION["usucde"];
            $sql = "SELECT t.*, (SELECT AGECOL FROM GM_AGE WHERE AGECOD=(SELECT TARCAG FROM GM_TAR WHERE TARCOD=t.TARCOD))'AGECOL',(SELECT AU_MOS FROM GM_AGE_USU WHERE AGECOD=(SELECT TARCAG FROM GM_TAR WHERE TARCOD=t.TARCOD) AND USUCOD=$usuario)'AU_MOS',(SELECT NOTTIP FROM GM_NOT WHERE NOTCUS=$usuario AND t.TARCOD=NOTCTA AND NOTLEI=0 GROUP by NOTCTA)'NOTIFICACION'
                FROM GM_TAR t, GM_USU u 
                WHERE (((t.TARASI = u.USUCOD OR t.TARCRE=u.USUCOD) AND u.USUCOD=$usuario) OR (t.TARCDE=$usucde AND (t.TARTIP='EVE' OR t.TARTIP='PRO'))";
            $sql .= $date;
            if ($_SESSION["usumni"] == 0) {
                $sql .= " AND TAREST!=-1";
            }
            if ($_SESSION["usumep"] == 0) {
                $sql .= " AND TAREST!=0";
            }
            if ($_SESSION["usumfi"] == 0) {
                $sql .= " AND TAREST!=1";
            }
            $sql .= " GROUP BY t.TARCOD ORDER BY NOTIFICACION DESC,t.TARINI,t.TAREST DESC";
        } else {
            $sql = "SELECT t.*, (SELECT AGECOL FROM GM_AGE WHERE AGECOD=(SELECT TARCAG FROM GM_TAR WHERE TARCOD=t.TARCOD))'AGECOL',(SELECT AU_MOS FROM GM_AGE_USU WHERE AGECOD=(SELECT TARCAG FROM GM_TAR WHERE TARCOD=t.TARCOD) AND USUCOD=$usuario)'AU_MOS',(SELECT NOTTIP FROM GM_NOT WHERE NOTCUS=u.USUCOD AND t.TARCOD=NOTCTA AND NOTLEI=0 GROUP by NOTCTA)'NOTIFICACION'
                FROM GM_TAR t, GM_USU u 
                WHERE ((t.TARASI = u.USUCOD || t.TARCRE=u.USUCOD) AND u.USUCOD=$usuario";
            $sql .= $date;
            if ($_SESSION["usumni"] == 0) {
                $sql .= " AND TAREST!=-1";
            }
            if ($_SESSION["usumep"] == 0) {
                $sql .= " AND TAREST!=0";
            }
            if ($_SESSION["usumfi"] == 0) {
                $sql .= " AND TAREST!=1";
            }
            $sql .= ") GROUP BY t.TARCOD ORDER BY NOTIFICACION DESC,t.TARINI,t.TAREST DESC";
        }
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        return $this->gets;
    }
    public function cambiarVisionado($tipo)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $this->conectarse();
        $sql = "UPDATE GM_USU SET USUVIS=$tipo WHERE NOTCUS=" . $_SESSION["codigo_usuario"];
        mysqli_query($this->conn, $sql);
        $_SESSION["usuvis"] = $tipo;
    }
    public function getNotificaciones()
    {
        $contador = 0;
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (isset($_SESSION["codigo_usuario"])) {
            $usuario = $_SESSION["codigo_usuario"];
            $sql = "SELECT * FROM GM_NOT n, GM_TAR t WHERE n.NOTCUS=$usuario AND t.TARCOD=n.NOTCTA AND n.NOTLEI=0 GROUP BY NOTCTA";
            $this->conectarse();
            foreach ($this->conn->query($sql) as $res) {
                $contador++;
            }
        }
        return $contador;
    }

    public function getTareasBusqueda($busqueda)
    {
        $this->conectarse();
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if ($busqueda <> '') {
            //CUENTA EL NUMERO DE PALABRAS
            $trozos = explode("%20", $busqueda);
            $numero = count($trozos);
            $usuario = $_SESSION["codigo_usuario"];
            $usudep = "'" . $_SESSION["usudep"] . "'";
            if ($numero == 1) {
                if ($_SESSION["usures"] == 1) {
                    //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE
                    $sql = "SELECT t.*,
                    ((SELECT COUNT(*) FROM GM_ARC WHERE ARCCTA=t.TARCOD)-4)'total_archivos',
                    (SELECT AGECOL FROM GM_AGE WHERE AGECOD=(SELECT TARCAG FROM GM_TAR WHERE TARCOD=t.TARCOD))'AGECOL'
                    FROM GM_TAR t, GM_USU u
                    WHERE  (((t.TARASI = u.USUCOD OR t.TARCRE=u.USUCOD) AND u.USUCOD=$usuario) OR (t.TARDEP=$usudep AND (t.TARTIP='EVE' OR t.TARTIP='PRO')))
                    AND (TARTIT LIKE '%$busqueda%' OR TARTEX LIKE '%$busqueda%') GROUP BY TARCOD";
                } else {
                    $sql = "SELECT t.*,
                    ((SELECT COUNT(*) FROM GM_ARC WHERE ARCCTA=t.TARCOD)-4)'total_archivos',
                    (SELECT AGECOL FROM GM_AGE WHERE AGECOD=(SELECT TARCAG FROM GM_TAR WHERE TARCOD=t.TARCOD))'AGECOL'
                    FROM GM_TAR t, GM_USU u
                    WHERE (t.TARASI = u.USUCOD || t.TARCRE=u.USUCOD) AND u.USUCOD=$usuario 
                    AND (TARTIT LIKE '%$busqueda%' OR TARTEX LIKE '%$busqueda%') GROUP BY TARCOD";
                }
            } else if ($numero > 1) {
                //SI HAY UNA FRASE SE UTILIZA EL ALGORTIMO DE BUSQUEDA AVANZADO DE MATCH AGAINST
                //busqueda de frases con mas de una palabra y un algoritmo especializado
                $busqueda = implode(" ", $trozos);
                if ($_SESSION["usures"] == 1) {
                    $sql = "SELECT t.*,
                    ((SELECT COUNT(*) FROM GM_ARC WHERE ARCCTA=t.TARCOD)-4)'total_archivos',
                    (SELECT AGECOL FROM GM_AGE WHERE AGECOD=(SELECT TARCAG FROM GM_TAR WHERE TARCOD=t.TARCOD))'AGECOL',
                    MATCH (TARTIT, TARTEX) AGAINST ('$busqueda' IN BOOLEAN MODE) AS Score 
                    FROM GM_TAR t, GM_USU u
                    WHERE (((t.TARASI = u.USUCOD OR t.TARCRE=u.USUCOD) AND u.USUCOD=$usuario) OR (t.TARDEP=$usudep AND (t.TARTIP='EVE' OR t.TARTIP='PRO')))
                    AND MATCH (TARTIT, TARTEX) AGAINST ('$busqueda' IN BOOLEAN MODE) 
                    GROUP BY TARCOD ORDER BY Score DESC";
                } else {
                    $sql = "SELECT t.*,
                    ((SELECT COUNT(*) FROM GM_ARC WHERE ARCCTA=t.TARCOD)-4)'total_archivos',
                    (SELECT AGECOL FROM GM_AGE WHERE AGECOD=(SELECT TARCAG FROM GM_TAR WHERE TARCOD=t.TARCOD))'AGECOL',
                    MATCH (TARTIT, TARTEX) AGAINST ('$busqueda' IN BOOLEAN MODE) AS Score 
                    FROM GM_TAR t, GM_USU u
                    WHERE (t.TARASI = u.USUCOD || t.TARCRE=u.USUCOD) AND u.USUCOD=$usuario 
                    AND MATCH (TARTIT, TARTEX) AGAINST ('$busqueda' IN BOOLEAN MODE) 
                    GROUP BY TARCOD ORDER BY Score DESC";
                }
                //se podria quitar lo de in boolean mode, pero no devolvera nada si hay mas de un 50% de resultados coincidentes al realizar la busqueda
            }
        }
        // echo $sql;
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        $this->closeConection();
        return $this->gets;
    }
    public function getTotalEstado($tipo, $estado)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (isset($_SESSION["codigo_usuario"])) {
            if ($tipo == 0) {
                $sql = "SELECT COUNT(*)'contador' FROM GM_TAR WHERE TARASI=" . $_SESSION["codigo_usuario"] . " AND TAREST=$estado";
            } else {
                $sql = "SELECT COUNT(*)'contador' FROM GM_TAR WHERE TARCRE=" . $_SESSION["codigo_usuario"] . " AND TAREST=$estado";
            }
            $this->conectarse();
            foreach ($this->conn->query($sql) as $res) {
                $this->gets[] = $res;
            }
            return $this->gets[0];
        } else {
            return 0;
        }
    }
    public function editarNotificacion($id)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $this->conectarse();
        $sql = "UPDATE GM_NOT SET NOTLEI=1 WHERE $id=NOTCTA AND NOTCUS=" . $_SESSION["codigo_usuario"];
        // echo $sql;
        mysqli_query($this->conn, $sql);
    }
    public function getTarea($id)
    {
        $this->conectarse();
        $sql = "SELECT t.*,a.*, (SELECT USUNOM FROM GM_USU WHERE USUCOD=t.TARCRE)'USUNOM', (SELECT USUNOM FROM GM_USU WHERE USUCOD=t.TARASI)'ASINOM', (SELECT USUAPE FROM GM_USU WHERE USUCOD=t.TARCRE)'USUAPE',(SELECT USUAPE FROM GM_USU WHERE USUCOD=t.TARASI)'ASIAPE',(SELECT CATNOM FROM GM_CAT WHERE CATCOD=(SELECT TARCCA FROM GM_TAR WHERE TARCOD=t.TARCOD))'CATNOM',(SELECT DEPNOM FROM GM_DEP WHERE DEPCOD=(SELECT TARCDE FROM GM_TAR WHERE TARCOD=t.TARCOD))'TARDEP' FROM GM_TAR t, GM_AGE a WHERE t.TARCOD=$id AND t.TARCAG=a.AGECOD";
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        return $this->gets[0];
    }
    public function getUsuariosAsignados($id)
    {
        $this->conectarse();
        $sql = "SELECT * FROM GM_USU u,GM_USU_CAT uc,GM_TAR t WHERE t.TARCOD=$id AND t.TARCCA=uc.CATCOD AND uc.USUCOD=u.USUCOD";
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        return $this->gets;
    }
    public function getSubtareas($id)
    {
        $this->select("GM_SUB", "SUBCTA", $id);
        return $this->gets;
    }
    public function getArchivos($id_tarea, $origen)
    {
        $this->conectarse();
        $sql = "SELECT * FROM GM_ARC WHERE ARCCTA=$id_tarea AND ARCORI=$origen";
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        return $this->gets;
    }
    public function getTotalArchivos($tareas)
    {
        $this->conectarse();
        foreach ($tareas as $tarea) {
            $sql = "SELECT * FROM GM_ARC WHERE ARCCTA = " . $tarea["TARCOD"];
            foreach ($this->conn->query($sql) as $res) {
                $this->gets[] = $res;
            }
        }
        return $this->gets;
    }

    public function getUsuario()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (isset($_SESSION["codigo_usuario"])) {
            $id = $_SESSION["codigo_usuario"];
            $this->select("GM_USU", "USUCOD", $id);
            return $this->gets[0];
        } else {
            return 0;
        }
    }
    public function getUsuarios()
    {
        $this->conectarse();
        $sql = "SELECT u.*,d.DEPNOM FROM GM_USU u, GM_DEP d WHERE d.DEPCOD=u.USUCDE";
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        return $this->gets;
    }
    public function getUsuariosSubordinados()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $usucde = $_SESSION["usucde"];
        $this->select("GM_USU", "USUCDE", $usucde);
        return $this->gets;
    }
    public function getDepartamentos()
    {
        // $this->select("GM_DEP", "", 0);
        $this->conectarse();
        $sql = "SELECT d.* FROM GM_DEP d,GM_AGE_DEP ad WHERE ad.AGECOD!=10 AND ad.DEPCOD=d.DEPCOD";
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        return $this->gets;
    }
    public function getDepartamentosMesgal()
    {
        $this->conectarse();
        $sql = "SELECT d.* FROM GM_DEP d,GM_AGE_DEP ad WHERE ad.AGECOD=10 AND ad.DEPCOD=d.DEPCOD";
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        return $this->gets;
    }

    public function getSecciones()
    {
        $this->conectarse();
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $user = $_SESSION["codigo_usuario"];
        $sql = "SELECT s.*,a.* FROM GM_SEC s,GM_AGE_USU a WHERE s.SECCAG=a.AGECOD AND a.USUCOD=$user ORDER BY SECCAG";
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        return $this->gets;
    }
    public function getCategorias()
    {
        $this->conectarse();
        $sql = "SELECT * FROM GM_CAT ORDER BY CATCDE";
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        return $this->gets;
    }
    public function getMisCategorias()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $this->conectarse();
        if ($_SESSION["usures"] == 1) {
            $sql = "SELECT * FROM GM_CAT WHERE CATDEP='" . $_SESSION["usudep"] . "'";
            foreach ($this->conn->query($sql) as $res) {
                $this->gets[] = $res;
            }
        }
        return $this->gets;
    }
    public function editarFechaTareaUnica($tarea)
    {
        if (!empty($_GET["dia"])) {
            $dia_cambiar = new DateTime($_GET["dia"]);
            $this->conectarse();
            $sql = "UPDATE GM_TAR SET TARINI='" . date($dia_cambiar->format('Y-m-d')) . "', TARFIN='" . date($dia_cambiar->format('Y-m-d')) . "',TARNOT='EDI' WHERE $tarea=TARCOD";
            mysqli_query($this->conn, $sql);
        }
        header('Location:' . getenv('HTTP_REFERER'));
    }
    public function editarFechaTareaInicio($tarea)
    {
        if (!empty($_GET["dia"])) {
            $dia_cambiar = new DateTime($_GET["dia"]);
            $this->conectarse();
            $sql = "UPDATE GM_TAR SET TARINI='" . date($dia_cambiar->format('Y-m-d')) . "',TARNOT='EDI' WHERE $tarea=TARCOD";
            mysqli_query($this->conn, $sql);
        }
        header('Location:' . getenv('HTTP_REFERER'));
    }
    public function editarFechaTareaFin($tarea)
    {
        if (!empty($_GET["dia"])) {
            $dia_cambiar = new DateTime($_GET["dia"]);
            $this->conectarse();
            $sql = "UPDATE GM_TAR SET TARFIN='" . date($dia_cambiar->format('Y-m-d')) . "',TARNOT='EDI' WHERE $tarea=TARCOD";
            mysqli_query($this->conn, $sql);
        }
        header('Location:' . getenv('HTTP_REFERER'));
    }
    public function editarEstado($tarea, $procedencia)
    {
        $this->conectarse();
        if (isset($_POST["estado"])) {
            if ($_POST["estado"] == 1) {
                $this->conectarse();
                //creador de la tarea
                $sql = "SELECT *
                FROM GM_TAR
                WHERE TARCOD=$tarea";
                $creador = 0;
                $tipo = "";
                foreach ($this->conn->query($sql) as $res) {
                    $creador = $res["TARCRE"];
                    $tipo = $res["TARTIP"];
                }
                $this->crearNotificacion($tarea, $creador, 'FIN');

                if ($tipo == "EVE") {
                    //Responsables departamento
                    $sql = "SELECT u.*
                    FROM GM_TAR t, GM_USU u
                    WHERE u.USUCDE=t.TARCDE AND u.USURES=1 AND TARCOD=$tarea";
                    foreach ($this->conn->query($sql) as $res) {
                        $this->crearNotificacion($tarea, $res["USUCOD"], 'FIN');
                    }
                }
            }
            $sql = "UPDATE GM_TAR SET TAREST=" . $_POST["estado"] . " WHERE $tarea=TARCOD";
        } else {
            $sql = "UPDATE GM_TAR SET TAREST=0 WHERE $tarea=TARCOD";
        }
        mysqli_query($this->conn, $sql);
        if ($procedencia != 0) {
            echo "<script>parent.actualizarCalendarioNuevo(" . $tarea . ");</script>";
        } else {
            echo "<script>parent.recargar();</script>";
        }
    }
    public function editarPreferenciaEstados()
    {
        $this->conectarse();
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $sql = "UPDATE GM_USU SET";
        if (isset($_POST["checkbox_-1"])) {
            $sql .= " USUMNI=" . $_POST["checkbox_-1"];
            $_SESSION["usumni"] = 1;
        } else {
            $sql .= " USUMNI=0";
            $_SESSION["usumni"] = 0;
        }
        if (isset($_POST["checkbox_-0"])) {
            $sql .= ", USUMEP=" . $_POST["checkbox_-1"];
            $_SESSION["usumep"] = 1;
        } else {
            $sql .= ", USUMEP=0";
            $_SESSION["usumep"] = 0;
        }
        if (isset($_POST["checkbox_-2"])) {
            $sql .= ", USUMFI=" . $_POST["checkbox_-1"];
            $_SESSION["usumfi"] = 1;
        } else {
            $sql .= ", USUMFI=0";
            $_SESSION["usumfi"] = 0;
        }
        $sql .= " WHERE USUCOD=" . $_SESSION["codigo_usuario"];
        mysqli_query($this->conn, $sql);
        header('Location:' . getenv('HTTP_REFERER') . "?id_desplegado=form_estados_visibles");
    }
    public function editarAgendasVisibles($id_agenda)
    {
        $this->conectarse();
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (isset($_POST["agenda"])) {
            $sql = "UPDATE GM_AGE_USU SET AU_MOS=1 WHERE AGECOD=$id_agenda AND USUCOD=" . $_SESSION["codigo_usuario"];
        } else {
            $sql = "UPDATE GM_AGE_USU SET AU_MOS=0 WHERE AGECOD=$id_agenda AND USUCOD=" . $_SESSION["codigo_usuario"];
        }
        mysqli_query($this->conn, $sql);
        header('Location:' . getenv('HTTP_REFERER'));
    }
    public function adjuntarArchivos($tarea)
    {
        if (($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/jpeg") // JPEG JPG
            || ($_FILES["file"]["type"] == "image/png") // PNG
            || ($_FILES["file"]["type"] == "image/gif") // GIF
            || ($_FILES["file"]["type"] == "image/webp") // WEBP
            || ($_FILES["file"]["type"] == "application/pdf") // PDF
            || ($_FILES["file"]["type"] == "image/svg+xml") // SVG
            || ($_FILES["file"]["type"] == "application/msword") // WORD
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") // WORD
            || ($_FILES["file"]["type"] == "application/vnd.ms-excel") // EXCELL
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") // EXCELL
            || ($_FILES["file"]["type"] == "application/zip") // ZIP
            || ($_FILES["file"]["type"] == "audio/wav") // WAV
            || ($_FILES["file"]["type"] == "audio/mpeg") //MPEG
            || ($_FILES["file"]["type"] == "video/mp4") //MP4
            || ($_FILES["file"]["type"] == "video/mpeg") //MPEG
            || ($_FILES["file"]["type"] == "video/x-msvideo") //AVI
            || ($_FILES["file"]["type"] == "text/css") //CSS
            || ($_FILES["file"]["type"] == "text/plain") //TXT
            || ($_FILES["file"]["type"] == "application/x-7z-compressed") //7X
            || ($_FILES["file"]["type"] == "text/x-sass") //SASS
        ) {
            $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/tmp";
            move_uploaded_file($_FILES["file"]["tmp_name"], $directorio . "/" . $_FILES['file']['name']);
            // $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea;
            // if (!is_dir($directorio)) {
            //     mkdir($directorio, 0777);
            // }
            // move_uploaded_file($_FILES["file"]["tmp_name"], $directorio . "/" . $_FILES['file']['name']);
        }
    }
    public function adjuntarArchivosNuevos()
    {
        if (($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/jpeg") // JPEG
            || ($_FILES["file"]["type"] == "image/png") // PNG
            || ($_FILES["file"]["type"] == "image/gif") // GIF
            || ($_FILES["file"]["type"] == "image/webp") // WEBP
            || ($_FILES["file"]["type"] == "application/pdf") // PDF
            || ($_FILES["file"]["type"] == "image/svg+xml") // SVG
            || ($_FILES["file"]["type"] == "application/msword") // WORD
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") // WORD
            || ($_FILES["file"]["type"] == "application/vnd.ms-excel") // EXCELL
            || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") // EXCELL
            || ($_FILES["file"]["type"] == "application/zip") // ZIP
            || ($_FILES["file"]["type"] == "audio/wav") // WAV
            || ($_FILES["file"]["type"] == "audio/mpeg") //MPEG
            || ($_FILES["file"]["type"] == "video/mp4") //MP4
            || ($_FILES["file"]["type"] == "video/mpeg") //MPEG
            || ($_FILES["file"]["type"] == "video/x-msvideo") //AVI
            || ($_FILES["file"]["type"] == "text/css") //CSS
            || ($_FILES["file"]["type"] == "text/plain") //TXT
            || ($_FILES["file"]["type"] == "application/x-7z-compressed") //7X
            || ($_FILES["file"]["type"] == "text/x-sass") //SASS
        ) {
            $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/tmp";
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777);
            }
            move_uploaded_file($_FILES["file"]["tmp_name"], $directorio . "/" . $_FILES['file']['name']);
        }
    }
    public function crearNotificacion($tarea, $usuario, $tipo)
    {
        // $valores = ["NULL", $tarea, $usuario, "'$tipo'", 0];
        // $this->insert("GM_NOT", $valores);
        $this->conectarse();
        $sql = "INSERT INTO GM_NOT(`NOTCOD`, `NOTCTA`, `NOTCUS`, `NOTTIP`, `NOTLEI`) VALUES (NULL,$tarea,$usuario,'" . $tipo . "',0)";
        if (!mysqli_query($this->conn, $sql)) {
            $sql = "UPDATE GM_NOT SET `NOTLEI`=0 WHERE $tarea=NOTCTA AND $usuario=NOTCUS AND '" . $tipo . "'=NOTTIP";
        }
    }
    public function crearTarea()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $t = $_POST['titulo'];
        $ini = $_POST['f_ini'];
        $fin = $_POST['f_fin'];
        $text = $_POST['descripcion'];
        $creador = $_SESSION["codigo_usuario"];
        $asi = $_POST['asignado'];
        $agenda = $_POST['agenda'];
        $departamento = $_POST['departamento'];

        if (isset($_POST['urgente'])) {
            $urgente = 1; //$this->comprobarVacio($_POST['urgente']);
        } else {
            $urgente = 0;
        }
        if (isset($_POST['modificaciones'])) {
            $modificaciones = 1; //$this->comprobarVacio($_POST['urgente']);
        } else {
            $modificaciones = 0;
        }
        // $urgente = $this->comprobarVacio($_POST['urgente']);
        // $modificaciones = $this->comprobarVacio($_POST['modificaciones']);
        if ($_SESSION["codigo_usuario"] == $asi) {
            $valores = ["NULL", "'$t'", "'$ini'", "'$fin'", "'$text'", -1, $creador, $asi, $agenda, "NULL", "'ACT'", "'$departamento'", "NULL", "NULL", $urgente, "'CRE'", $modificaciones];
        } else {
            $valores = ["NULL", "'$t'", "'$ini'", "'$fin'", "'$text'", -1, $creador, $asi, $agenda, "NULL", "'TAR'", "'$departamento'", "NULL", "NULL", $urgente, "'CRE'", $modificaciones];
        }
        $this->insert("GM_TAR", $valores);
        $tarea = $this->lastid;
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea;
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea . "/adjuntos";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }

        $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/tmp";
        $dir = opendir($path);
        while ($current = readdir($dir)) {
            if ($current != "." && $current != "..") {
                rename($path . "/" . $current, $directorio . "/" . $current);
                $tipo = explode(".", $current);
                $tam = count($tipo) - 1;
                $tip = $tipo[$tam];
                switch ($tip) {
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'gif':
                    case 'webp':
                    case 'svg':
                        $tip = "IMG";
                        break;
                    case 'mp4':
                    case 'mpeg':
                        $tip = "VID";
                        break;
                    case 'wav':
                    case 'avi':
                        $tip = "AUD";
                        break;
                    case 'pdf':
                        $tip = "PDF";
                        break;
                    case 'doc':
                    case 'docx':
                        $tip = "WOR";
                        break;
                    case 'xls':
                    case 'xlsx':
                        $tip = "EXC";
                        break;
                    case 'zip':
                    case '7z':
                        $tip = "ZIP";
                        break;
                    case 'css':
                    case 'sass':
                        $tip = "CSS";
                        break;
                    case 'txt':
                        $tip = "TXT";
                        break;
                    default:
                        $tip = "NAN";
                        break;
                }
                $valores = ["NULL", "'$current'", "'$tip'", $tarea, 0, "NULL"];
                $this->insert("GM_ARC", $valores);
            }
        }
        if ($_SESSION["codigo_usuario"] != $asi) {
            $this->crearNotificacion($tarea, $asi, 'CRE');
        }
        echo "<script>parent.actualizarCalendarioNuevo(" . $tarea . ");</script>";
        // $url = base_url() . "planner/tarea/" . $tarea . "?nueva_tarea=1";
        // header('Location:' . $url);
    }

    public function crearEvento()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();

        $ini = $_POST['f_ini'];
        $fin = $_POST['f_fin'];
        $text = $_POST['descripcion'];
        $creador = $_SESSION["codigo_usuario"];
        $agenda = $_POST['agenda'];
        $departamento = $_POST['departamento'];
        $categoria = $this->comprobarVacio($_POST['categoria']);

        if (isset($_POST['urgente'])) {
            $urgente = 1; //$this->comprobarVacio($_POST['urgente']);
        } else {
            $urgente = 0;
        }
        if (isset($_POST['modificaciones'])) {
            $modificaciones = 1; //$this->comprobarVacio($_POST['urgente']);
        } else {
            $modificaciones = 0;
        }

        if ($_POST['seccion'] != -1 && $_POST['seccion'] != -2) {
            $t = $_POST['seccion'];
        } else {
            $t = $_POST['titulo'];
        }
        $valores = ["NULL", "'$t'", "'$ini'", "'$fin'", "'$text'", -1, $creador, "NULL", $agenda, "NULL", "'EVE'", "'$departamento'", "'$categoria'", "NULL", $urgente, "'CRE'", $modificaciones];
        $this->insert("GM_TAR", $valores);
        $tarea = $this->lastid;
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea;
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea . "/adjuntos";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }

        $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/tmp";
        $dir = opendir($path);
        while ($current = readdir($dir)) {
            if ($current != "." && $current != "..") {
                rename($path . "/" . $current, $directorio . "/" . $current);
                $tipo = explode(".", $current);
                $tam = count($tipo) - 1;
                $tip = $tipo[$tam];
                switch ($tip) {
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'gif':
                    case 'webp':
                    case 'svg':
                        $tip = "IMG";
                        break;
                    case 'mp4':
                    case 'mpeg':
                        $tip = "VID";
                        break;
                    case 'wav':
                    case 'avi':
                        $tip = "AUD";
                        break;
                    case 'pdf':
                        $tip = "PDF";
                        break;
                    case 'doc':
                    case 'docx':
                        $tip = "WOR";
                        break;
                    case 'xls':
                    case 'xlsx':
                        $tip = "EXC";
                        break;
                    case 'zip':
                    case '7z':
                        $tip = "ZIP";
                        break;
                    case 'css':
                    case 'sass':
                        $tip = "CSS";
                        break;
                    case 'txt':
                        $tip = "TXT";
                        break;
                    default:
                        $tip = "NAN";
                        break;
                }
                $valores = ["NULL", "'$current'", "'$tip'", $tarea, 0, "NULL"];
                $this->insert("GM_ARC", $valores);
            }
        }

        $this->conectarse();
        //Responsables departamento
        $sql = "SELECT * FROM GM_USU WHERE USURES=1 AND USUCDE=$departamento";
        foreach ($this->conn->query($sql) as $res) {
            $this->crearNotificacion($tarea, $res["USUCOD"], 'CRE');
        }
        //Asignados
        $sql = "SELECT * FROM GM_USU_CAT WHERE CATCOD=$categoria";
        foreach ($this->conn->query($sql) as $res) {
            $this->crearNotificacion($tarea, $res["USUCOD"], 'CRE');
        }
        echo "<script>parent.actualizarCalendarioNuevo(" . $tarea . ");</script>";
    }
    public function eliminarArchivo($archivo)
    {
        if (isset($_GET["tipo"]) && $_GET["tipo"] == 'origen') {
            $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $_GET["tarea"] . "/adjuntos/";
        } else {
            $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $_GET["tarea"] . "/respuestas/";
        }
        $order   = '%20';
        $replace = ' ';
        $newstr = str_replace($order, $replace, $archivo);
        unlink($directorio . $newstr);
        $clave =  ["ARCURL", "ARCCTA"];
        $valor = ["'$newstr'", $_GET["tarea"]];
        $this->delete("GM_ARC", $clave, $valor);
        header('Location:' . getenv('HTTP_REFERER'));
    }
    public function eliminarArchivosTemporales()
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/tmp";
        $dir = opendir($path);
        while ($current = readdir($dir)) {
            if ($current != "." && $current != "..") {
                unlink($path  . "/" . $current);
            }
        }
    }
    public function editarRespuesta($tarea)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea;
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea . "/respuestas";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }

        $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/tmp"; // . $tarea . "/respuestas";
        $dir = opendir($path);
        while ($current = readdir($dir)) {
            if ($current != "." && $current != "..") {
                rename($path . "/" . $current, $directorio . "/" . $current);
                $tipo = explode(".", $current);
                $tam = count($tipo) - 1;
                $tip = $tipo[$tam];
                switch ($tip) {
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'gif':
                    case 'webp':
                    case 'svg':
                        $tip = "IMG";
                        break;
                    case 'mp4':
                    case 'mpeg':
                        $tip = "VID";
                        break;
                    case 'wav':
                    case 'avi':
                        $tip = "AUD";
                        break;
                    case 'pdf':
                        $tip = "PDF";
                        break;
                    case 'doc':
                    case 'docx':
                        $tip = "WOR";
                        break;
                    case 'xls':
                    case 'xlsx':
                        $tip = "EXC";
                        break;
                    case 'zip':
                    case '7z':
                        $tip = "ZIP";
                        break;
                    case 'css':
                    case 'sass':
                        $tip = "CSS";
                        break;
                    case 'txt':
                        $tip = "TXT";
                        break;
                    default:
                        $tip = "NAN";
                        break;
                }
                $valores = ["NULL", "'$current'", "'$tip'", $tarea, 1, "NULL"];
                $this->insert("GM_ARC", $valores);
            }
        }
        if (isset($_POST["descripcion"])) {
            $this->conectarse();
            $sql = "UPDATE GM_TAR SET TARRES='" . $_POST["descripcion"] . "' WHERE " . $tarea . "=TARCOD";
            mysqli_query($this->conn, $sql);
        }

        $this->conectarse();
        //creador de la tarea
        $sql = "SELECT *
        FROM GM_TAR
        WHERE TARCOD=$tarea";
        $creador = 0;
        $tipo = "";
        foreach ($this->conn->query($sql) as $res) {
            $creador = $res["TARCRE"];
            $tipo = $res["TARTIP"];
        }
        $this->crearNotificacion($tarea, $creador, 'RES');

        if ($tipo == "EVE") {
            //Responsables departamento
            $sql = "SELECT u.*
            FROM GM_TAR t, GM_USU u
            WHERE u.USUCDE=t.TARCDE AND u.USURES=1 AND TARCOD=$tarea";
            foreach ($this->conn->query($sql) as $res) {
                $this->crearNotificacion($tarea, $res["USUCOD"], 'RES');
            }
        }
        header('Location:' . getenv('HTTP_REFERER'));
    }
    public function cancelarRespuesta($tarea)
    {
        $this->conectarse();
        $urls = [];
        $sql = "SELECT ARCURL FROM GM_ARC WHERE ARCCTA=$tarea AND ARCORI=1";
        foreach ($this->conn->query($sql) as $res) {
            $urls[] = $res["ARCURL"];
        }
        $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea;
        $dir = opendir($path);
        while ($current = readdir($dir)) {
            if ($current != "." && $current != "..") {
                if (!in_array($current, $urls)) {
                    unlink($path . "/" . $current);
                }
            }
        }
        header('Location:' . getenv('HTTP_REFERER'));
    }
    public function editarSubtarea()
    {
        $this->conectarse();
        $sql = "UPDATE GM_SUB SET SUBEST=" . $_POST["valor_subtarea"] . " WHERE " . $_POST["codigo_subtarea"] . "=SUBCOD";
        mysqli_query($this->conn, $sql);
        header('Location:' . getenv('HTTP_REFERER'));
        //echo "<script>parent.recargar();</script>";
    }
    function editarTarea($tarea)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $t = $_POST['titulo'];
        $ini = $_POST['f_ini'];
        $fin = $_POST['f_fin'];
        $text = $_POST['descripcion'];
        $creador = $_SESSION["codigo_usuario"];
        $asi = $_POST['asignado'];
        $agenda = $_POST['agenda'];
        $departamento = $_POST['departamento'];

        if (isset($_POST['urgente'])) {
            $urgente = 1; //$this->comprobarVacio($_POST['urgente']);
        } else {
            $urgente = 0;
        }
        if (isset($_POST['modificaciones'])) {
            $modificaciones = 1; //$this->comprobarVacio($_POST['urgente']);
        } else {
            $modificaciones = 0;
        }
        // $urgente = $this->comprobarVacio($_POST['urgente']);
        // $modificaciones = $this->comprobarVacio($_POST['modificaciones']);
        if ($_SESSION["codigo_usuario"] == $asi) {
            $valores = ["'$t'", "'$ini'", "'$fin'", "'$text'", -1, $creador, $asi, $agenda, "NULL", "'ACT'", "'$departamento'", "NULL", "NULL", $urgente, "'CRE'", $modificaciones];
        } else {
            $valores = ["'$t'", "'$ini'", "'$fin'", "'$text'", -1, $creador, $asi, $agenda, "NULL", "'TAR'", "'$departamento'", "NULL", "NULL", $urgente, "'CRE'", $modificaciones];
        }
        $clave = ["TARCOD"];
        $valor = [$tarea];
        $this->update("GM_TAR", $valores, $clave, $valor);
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea;
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea . "/adjuntos";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }

        $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/tmp";
        $dir = opendir($path);
        while ($current = readdir($dir)) {
            if ($current != "." && $current != "..") {
                rename($path . "/" . $current, $directorio . "/" . $current);
                $tipo = explode(".", $current);
                $tam = count($tipo) - 1;
                $tip = $tipo[$tam];
                switch ($tip) {
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'gif':
                    case 'webp':
                    case 'svg':
                        $tip = "IMG";
                        break;
                    case 'mp4':
                    case 'mpeg':
                        $tip = "VID";
                        break;
                    case 'wav':
                    case 'avi':
                        $tip = "AUD";
                        break;
                    case 'pdf':
                        $tip = "PDF";
                        break;
                    case 'doc':
                    case 'docx':
                        $tip = "WOR";
                        break;
                    case 'xls':
                    case 'xlsx':
                        $tip = "EXC";
                        break;
                    case 'zip':
                    case '7z':
                        $tip = "ZIP";
                        break;
                    case 'css':
                    case 'sass':
                        $tip = "CSS";
                        break;
                    case 'txt':
                        $tip = "TXT";
                        break;
                    default:
                        $tip = "NAN";
                        break;
                }
                $valores = ["NULL", "'$current'", "'$tip'", $tarea, 0, "NULL"];
                $this->insert("GM_ARC", $valores);
            }
        }
        if ($_SESSION["codigo_usuario"] != $asi) {
            $this->crearNotificacion($tarea, $asi, 'EDI');
        }
        echo "<script>parent.actualizarCalendarioNuevo(" . $tarea . ");</script>";
    }
    function editarEvento($evento)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();

        $ini = $_POST['f_ini'];
        $fin = $_POST['f_fin'];
        $text = $_POST['descripcion'];
        $creador = $_SESSION["codigo_usuario"];
        $agenda = $_POST['agenda'];
        $departamento = $_POST['departamento'];
        $categoria = $this->comprobarVacio($_POST['categoria']);

        if (isset($_POST['urgente'])) {
            $urgente = 1; //$this->comprobarVacio($_POST['urgente']);
        } else {
            $urgente = 0;
        }
        if (isset($_POST['modificaciones'])) {
            $modificaciones = 1; //$this->comprobarVacio($_POST['urgente']);
        } else {
            $modificaciones = 0;
        }

        if ($_POST['seccion'] != -1) {
            $t = $_POST['seccion'];
        } else {
            $t = $_POST['titulo'];
        }
        $valores = ["'$t'", "'$ini'", "'$fin'", "'$text'", -1, $creador, "NULL", $agenda, "NULL", "'EVE'", "'$departamento'", "'$categoria'", "NULL", $urgente, "'CRE'", $modificaciones];
        $clave = ["TARCOD"];
        $valor = [$evento];
        $this->update("GM_TAR", $valores, $clave, $valor);
        $tarea = $evento;
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea;
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/" . $tarea . "/adjuntos";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777);
        }

        $path = $_SERVER['DOCUMENT_ROOT'] . "/assets/archivos/tmp";
        $dir = opendir($path);
        while ($current = readdir($dir)) {
            if ($current != "." && $current != "..") {
                rename($path . "/" . $current, $directorio . "/" . $current);
                $tipo = explode(".", $current);
                $tam = count($tipo) - 1;
                $tip = $tipo[$tam];
                switch ($tip) {
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                    case 'gif':
                    case 'webp':
                    case 'svg':
                        $tip = "IMG";
                        break;
                    case 'mp4':
                    case 'mpeg':
                        $tip = "VID";
                        break;
                    case 'wav':
                    case 'avi':
                        $tip = "AUD";
                        break;
                    case 'pdf':
                        $tip = "PDF";
                        break;
                    case 'doc':
                    case 'docx':
                        $tip = "WOR";
                        break;
                    case 'xls':
                    case 'xlsx':
                        $tip = "EXC";
                        break;
                    case 'zip':
                    case '7z':
                        $tip = "ZIP";
                        break;
                    case 'css':
                    case 'sass':
                        $tip = "CSS";
                        break;
                    case 'txt':
                        $tip = "TXT";
                        break;
                    default:
                        $tip = "NAN";
                        break;
                }
                $valores = ["NULL", "'$current'", "'$tip'", $tarea, 0, "NULL"];
                $this->insert("GM_ARC", $valores);
            }
        }
        $this->conectarse();
        //Responsables departamento
        $sql = "SELECT * FROM GM_USU WHERE USURES=1 AND USUCDE=$departamento";
        foreach ($this->conn->query($sql) as $res) {
            $this->crearNotificacion($tarea, $res["USUCOD"], 'EDI');
        }
        //asignados
        $sql = "SELECT * FROM GM_USU_CAT WHERE CATCOD=$categoria";
        foreach ($this->conn->query($sql) as $res) {
            $this->crearNotificacion($tarea, $res["USUCOD"], 'EDI');
        }
        echo "<script>parent.actualizarCalendarioNuevo(" . $tarea . ");</script>";
    }
    function eliminarTarea($tarea)
    {
        $clave = ["TARCOD"];
        $valor = [$tarea];
        $this->delete("GM_TAR", $clave, $valor);
        //borrar archivos
        $this->conectarse();
        $sql = "DELETE FROM GM_ARC WHERE ARCCTA=$tarea";
        mysqli_query($this->conn, $sql);
        //borrar notificaciones
        $this->conectarse();
        $sql = "DELETE FROM GM_NOT WHERE NOTCTA=$tarea";
        mysqli_query($this->conn, $sql);
        echo "<script>parent.recargar();</script>";
    }
    public function cambiar_contrasena()
    {
        $email = $_REQUEST['email'];
        // $codigo = $_REQUEST['codigo_recuperacion'];
        $contrasena = $_REQUEST['contrasena'];
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);
        $this->conectarse();
        //query para comprobar si existe el correo y si tiene contraseña
        $sql = "UPDATE GM_USU SET USUCON = '$hashed_password' WHERE USUEMA = '$email'";
        mysqli_query($this->conn, $sql);
    }












    //////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////
    private function conectarse()
    {
        $this->conn = mysqli_connect("localhost:3306", "plannermesgal", "puFF44lsjdM0XnXF", "GM_");
        $this->conn->set_charset("utf8");
        if ($this->conn === false) {
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
        $this->conn->query("SET NAMES 'utf8'");
        $this->gets = [];
    }


    private function closeConection()
    {
        mysqli_close($this->conn);
    }
    private function comprobarVacio($valor)
    {
        if (!($valor == null)) {
            return $valor;
        } else {
            return NULL;
        };
    }
    private function comprobarVacioNumerico($valor)
    {
        if (!($valor == null)) {
            return $valor;
        } else {
            return -1;
        };
    }
    private function getAtributos($tabla)
    {
        $this->conectarse();
        $sql = "SELECT column_name FROM information_schema.COLUMNS WHERE table_name LIKE '$tabla' ORDER BY ordinal_position";
        foreach ($this->conn->query($sql) as $res) {
            $this->atributos[] = $res;
        }
    }
    private function insert($tabla, $valores)
    {
        $this->conectarse();
        //////////////////////////////////////////
        //$atr = implode(",", $this->atributos);
        $val = implode(",", $valores);
        $sql = "INSERT INTO $tabla VALUES ($val)";
        mysqli_query($this->conn, $sql);
        // if (mysqli_query($this->conn, $sql)) {
        //     echo "<br><h3>Fila insertada $sql</h3>";
        // } else {
        //     echo "<br>ERROR: $sql";
        //     echo "<br> " . mysqli_error($this->conn);
        // }
        $this->lastid = mysqli_insert_id($this->conn);
        //////////////////////////////////////////
        $this->closeConection();
    }
    private function update($tabla, $valores, $clave, $valor)
    {
        $this->getAtributos($tabla);
        //////////////////////////////////////////array_shift
        $fin = [];
        $where = [];
        for ($i = 0; $i < count($clave); $i++) {

            if ($i > 0) {
                array_push($where, "AND $clave[$i]=$valor[$i]");
            } else {
                array_push($where, "$clave[$i]=$valor[$i]");
            }
            //array_shift($atributos);
        }

        for ($i = count($clave); $i < count($this->atributos); $i++) {
            $var1 = $this->atributos[$i]["column_name"];
            $var2 = $valores[$i - count($clave)];
            array_push($fin, "$var1=$var2");
        }
        /*   $i = 0;
        foreach ($this->atributos as $atr) {
            $i++;
            array_push($fin, "$atr=$valores[$i]");
        } */
        $final = implode(",", $fin);
        $condicion = implode(" ", $where);
        //////////////////////////////////////////
        $sql = "UPDATE $tabla SET $final WHERE $condicion";
        mysqli_query($this->conn, $sql);
        // if (mysqli_query($this->conn, $sql)) {
        //     echo "<h3>Fila editada</h3>";
        // } else {
        //     echo "ERROR: Hush! Sorry $sql. "
        //         . mysqli_error($this->conn);
        // }
        //////////////////////////////////////////
        $this->closeConection();
    }
    private function updateParte($tabla, $atributos, $valores, $clave, $valor)
    {
        $this->conectarse();
        //////////////////////////////////////////array_shift
        $fin = [];

        $where = [];
        for ($i = 0; $i < count($clave); $i++) {
            if ($i > 0) {
                array_push($where, "AND $clave[$i]=$valor[$i]");
            } else {
                array_push($where, "$clave[$i]=$valor[$i]");
            }
        }
        for ($i = 0; $i < count($atributos); $i++) {
            $var1 = $atributos[$i];
            $var2 = $valores[$i];
            array_push($fin, "$var1=$var2");
        }

        $final = implode(",", $fin);
        $condicion = implode(" ", $where);
        //////////////////////////////////////////
        $sql = "UPDATE $tabla SET $final WHERE $condicion";
        mysqli_query($this->conn, $sql);
        // if (mysqli_query($this->conn, $sql)) {
        //     echo "<h3>Fila editada</h3> $sql. ";
        // } else {
        //     echo "ERROR: Hush! Sorry $sql. "
        //         . mysqli_error($this->conn);
        // }
        //////////////////////////////////////////
        $this->closeConection();
    }

    private function delete($tabla, $clave, $valor)
    {
        $this->conectarse();
        //////////////////////////////////////////
        $where = "";
        for ($i = 0; $i < count($clave); $i++) {
            if ($i ==  (count($clave) - 1) && count($clave) > 1) {
                $where .= " AND $clave[$i]=$valor[$i]";
            } else {
                $where .= " $clave[$i]=$valor[$i]";
            }
        }
        // $condicion = implode(",", $where);
        //////////////////////////////////////////
        $sql = "DELETE FROM $tabla WHERE $where";
        mysqli_query($this->conn, $sql);
        // if (mysqli_query($this->conn, $sql)) {
        //     echo "<h3>Fila borrada</h3>";
        // } else {
        //     echo "//////////////////////////////////////////";
        //     echo "ERROR: Hush! Sorry $sql. "
        //         . mysqli_error($this->conn);
        // }
        //////////////////////////////////////////
        $this->closeConection();
    }
    private function select($tabla, $clave, $valor)
    {
        $this->conectarse();
        $sql = "SELECT * FROM $tabla";
        if ($clave != "") {
            $sql = "SELECT * FROM $tabla WHERE $clave=$valor";
        }
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        $this->closeConection();
    }

    private function selects($tabla, $clave, $valor)
    {
        $this->conectarse();
        //////////////////////////////////////////
        $where = [];
        for ($i = 0; $i < count($clave); $i++) {
            if ($i > 0) {
                array_push($where, "AND $clave[$i]=$valor[$i]");
            } else {
                array_push($where, "$clave[$i]=$valor[$i]");
            }
        }
        $condicion = implode(" ", $where);
        //////////////////////////////////////////
        $sql = "SELECT * FROM $tabla WHERE $condicion";
        foreach ($this->conn->query($sql) as $res) {
            $this->gets[] = $res;
        }
        //////////////////////////////////////////
        $this->closeConection();
    }
}
