
 <?php  abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}?>
   <div class="sticky-top">
        <div class="nav-logo row">
            <div class=" col-lg-0 col-md-0 col-sm-4 col-xs-0"></div>
                <div class="div-logo col-lg-3 col-md-4 col-sm-8 col-xs-12">
                    <label for="" class="logoS"><a href="#">
                       <a href="../../"> <p><img src="../../img/empresarial/logoSantee.png" alt="Colegio Santee"> </p> </a>   </a>
                    </label>
                </div>
            <div class="menu col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <nav>
                    
                    
                     
                <?php if(!isset($_SESSION['user'])):?>
                <a class="nav-bar desaparece" href="../../vistas/usuarios/login.php"> Login</a>
                <?php else:?>
                    <?php if(in_array('Enfermeria',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="../../vistas/enfermeria/eprincipal.php"> Enfermeria</a>
                <?php endif?>
                <?php if(in_array('Biblioteca',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="../../vistas/biblioteca/bprincipal.php"> Biblioteca</a>
                <?php endif?>
                <?php if(in_array('Directorio',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="#"> Directorio</a>
                <?php endif?>
                <?php if(in_array('Psicopedagogico',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="../../vistas/psicopedagogico/pprincipal.php"> Psicopedagógico</a>
                <?php endif?>
                <?php if(in_array('Prefectura',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="#"> Prefectura</a>
                <?php endif?>
              
                <?php if(in_array('Ajustes',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="../../vistas/usuarios/usuariosPrincipal.php"> Configuración</a>             
                <?php endif?>
               
               
                <?php endif?>
                <button class="nav-button" onclick="accion()">Menú</button>
                <br>
               <a class=" nav-button-logout" href="../../controlador/usuarios/logout.php"><center>LogOut</center> </a>
                 <br>
                </nav>
            </div>
        </div>
    </div>
    