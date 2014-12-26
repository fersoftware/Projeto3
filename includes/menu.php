<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <?php

                //Aprendendo a usar array_walk

                $pages = ['Home','Empresa','Produtos','Servicos', 'Contatos'];

                array_walk($pages,function ($x) use($pagina){

                        $content = "<a href='".strtolower($x)."'>".$x."</a>";
                        $li_str = "<li>" . $content . "</li>";

                        if(strtolower($x) == $pagina)
                        {
                            $li_str = "<li class='active'>" . $content . "</li>";
                        }

                        echo $li_str;
                    }
                );

                ?>
            </ul>
            <form class="form-search" method="post" action="home" style="margin: 0 0 0px;float: right;">
                <input type="text" name="busca" style="margin-top: 5px;" class="input-medium search-query">
                <button type="submit" class="btn">Busca</button>
            </form>
        </div>
    </div>
</div>
