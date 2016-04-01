<div class="leftHolder">
        	<a href="http://mogoolab.com" title="<?php echo  Yii::app()->name; ?>" class="logo" ><?php echo Yii::app()->name; ?></a>
            <div class="errorNumber"><?php echo $error['code']; ?></div> 
        </div>
        <div class="rightHolder">
        <h2></h2>   
        <?php if(Yii::app()->user->isSuperAdmin): ?>     
            <div class="message"><p>Error <?php echo $error['code'] ?></p><p><?php echo $error['message']; ?></p></div>
        <?php else: ?>
            <div class="message"><p><?php echo Yii::t('general','La p&aacute;gina solicitada no existe, o no tiene los permisos necesarios para ingresar, por favor verifique la Url de navegador o intente inciando sesi&oacute;n de nuevo'); ?></p></div>
        <?php endif; ?>
            <div class="robotik"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/robotik.png" alt="<?php echo Yii::t('general','Oooops....No podemos encontrar la p&aacute;gina.'); ?>" title="<?php echo Yii::t('general','Oooops....No podemos encontrar la p&aacute;gina.'); ?>." id="robot"></div>
            <div class="tryToMessage">
                <?php echo Yii::t('general','Intente');?>:
                <ul>
                    <li><?php echo Yii::t('general','Refrescar la p&aacute;gina');?></li>
                    <li><?php echo Yii::t('general','Vistar el');?> <a href="http://mogoolab.com" title="Sitemap"><?php echo Yii::t('general','Sitemap');?></a></li>
                    <li><?php echo Yii::t('general','Regresar');?> <a href="javascript:history.go(-1)" title="<?php echo Yii::t('general','Regresar');?>"><?php echo Yii::t('general','regresar');?></a></li>
                </ul>
            </div>
            <!-- Search Form -->
            <!--  <div class="search">
            <span class="errorSearch">Please fill the search field</span>
            <form action="" method="post">
              <div class="searchInput">
                <input type="text" name="search_term" value="Search" />
              </div>
              <div class="searchButton">
                <input type="submit" name="submit" value="Go" />
              </div>
            
            </form>
            </div>-->
            <!-- end .search -->
          </div>
        <footer>
        <p class="copy">&copy <?php echo date('Y'); echo ' '; echo Yii::t('general','Modular 404. Todos los derechos reservados');?>.</p>
        <menu>
            <li><a href="<?php echo Yii::app()->createUrl('/site/index'); ?>" title="Inicio">Inicio</a></li>
            <!-- <li><a href="http://mogoolab.com/who-we-are" title="About Us">About us</a></li>
            <li><a href="http://mogoolab.com/category/portfolio" title="Services">Services</a></li>
            <li><a href="http://mogoolab.com/" title="Partners">Partners</a></li>
            <li class="last"><a href="http://mogoolab.com/contact" title="Contact">Contact</a></li> -->
        </menu>
        </footer>        