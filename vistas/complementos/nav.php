
<?php  abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../");
}?>
   <div class="sticky-top">
        <div class="nav-logo row">
          
                <div class="div-logo col-lg-3 col-md-4 col-sm-8 col-xs-12">
               
                       <a href="../"> <img src="../img/empresarial/logoSantee.png" class="logo-navbar" alt="Colegio Santee">  </a>   
                
                </div>
            <div class="menu col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <nav>
                    
                    
                     
                <?php if(!isset($_SESSION['user'])):?>
                <a class="nav-bar desaparece" href="../vistas/usuarios/login.php"> Login</a>
                <?php else:?>
                    <?php if(in_array('Enfermeria',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="../vistas/enfermeria/eprincipal.php"> Enfermeria</a>
                <?php endif?>
                <?php if(in_array('Biblioteca',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="../vistas/biblioteca/bprincipal.php"> Biblioteca</a>
                <?php endif?>
              
                <?php if(in_array('Psicopedagogico',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="../vistas/psicopedagogico/pprincipal.php"> Psicopedagógico</a>
                <?php endif?>
            
              
                <?php if(in_array('Ajustes',$_SESSION['user']->perm)):?>
                <a class="nav-bar desaparece" href="../vistas/usuarios/usuariosPrincipal.php"> Configuración</a>             
                <?php endif?>
               
               
                <?php endif?>
                <button class="nav-button" onclick="accion()">Menú</button>
                <br>
               <a class=" nav-button" href="../controlador/usuarios/logout.php">LogOut </a>
                 <br>
                </nav>
            </div>
        </div>
    </div>
    