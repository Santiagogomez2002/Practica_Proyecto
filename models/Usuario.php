<?php 
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::Conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){

                $correo = $_POST["correo"];
                $password = $_POST["pass"];
                if(empty ($correo) and empty($password)){
                    header("Location:" .Conectar::ruta()."index.php?m=2");
                    exit();
                }else{                          //nombre de tabla       //NOMBRE DEL CAMPO
                    $sql = "SELECT * FROM usuario WHERE usu_correo=? and clave=? and estado=1";
                    $stmt = $conectar ->prepare($sql);
                    $stmt ->bindParam(1,$correo);
                    $stmt ->bindParam(2,$password);
                    $stmt ->execute();
                    $resultado = $stmt->fetch();
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION[ "usu_id"]=$resultado["usu_id"];
                        $_SESSION[ "nombre"]=$resultado["nombre"];
                        $_SESSION[ "apellido"]=$resultado["apellido"];
                        $_SESSION[ "usu_correo"]=$resultado["usu_correo"];
                        header("Location:" .Conectar::ruta()."views/inicio.php");
                        exit();                        

                    }else{
                        header("Location:" .Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                    
                    
  
                }
            }  
        }        
    }
    class curso_usuario extends Conectar{
        public function curso_usuario ($usu_id){ 
            $conectar-parent::Conexion(); 
            parent::set_names();

        $sql="SELECT 
        curso usuario.curusu_id, cursos.cur_id, cursos.curso, cursos.descripcion,
        cursos. fecha ini, cursos.fecha_fin, usuarios.usu_id,  usuarios.nombre,
        usuarios.ape_paterno, usuarios.ape_materno, instructor.inst_id,
        instructor.nombrei, instructor.ape_paternoi,instructor.ape_maternoi                  
        FROM curso_usuario INNER JOIN cursos ON curso_usuario.curusu_id = cursos.cur_id INNER JOIN
         usuarios ON curso usuario.id_usuario = usuarios.usu_id INNER JOIN
          instructor ON cursos.profesor instructor.inst_id 
        WHERE =
        curso_usuario.curusu_id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
        }
    }
?>