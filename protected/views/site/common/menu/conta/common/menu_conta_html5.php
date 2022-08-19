<?php $session = new CHttpSession; $session->open();?> 
<p>&nbsp;</p>
<ul class="nav nav-tabs">
    <li role="presentation" class="<?php if($menu_conta_active === 'avisos') echo "active"; ?>"><a href="/conta">Avisos</a></li>
    <li role="presentation" class="dropdown <?php if($menu_conta_active == 'profile') echo "active"; ?>">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Minha conta <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">      
            <li role="presentation"><a href="/conta/users/pf/editar">Meu perfil</a></li>
            <li role="presentation"><a href="/conta/users/nova_senha">Alterar senha</a></li>
            <?php if(defined('Settings::PIER_PUBLICIDADE_ONLINE') && Settings::PIER_PUBLICIDADE_ONLINE){ ?>
            <li role="presentation" class="hide"><a href="/conta/pagamento/investir">Adicionar créditos</a></li>
            <li role="presentation" class="hide"><a href="/conta/pagamento/todos">Realizar pagamento</a></li>
            <li role="presentation" class="hide"><a href="/conta/pagamento/transacoes">Minhas compras</a></li>
            <?php } ?>      
        </ul>
    </li>
    
    <?php if(defined('Settings::PIER_CURRICULUM') && Settings::PIER_CURRICULUM){ ?>
    <li role="presentation" class="dropdown <?php if($menu_conta_active == 'curriculum') echo "active"; ?>">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Currículum <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li role="presentation"><a href="/conta/curriculum/editar">Cadastrar / Editar</a></li>
            <li role="presentation"><a href="/conta/curriculum/acompanhamento">Relatório vagas</a></li>
        </ul>
    </li>
    <?php } ?>
    
    <?php if(defined('Settings::PIER_FORUM') && Settings::PIER_FORUM){ ?>
    <li role="presentation" class="dropdown <?php if($menu_conta_active == 'forum') echo "active"; ?>">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Fórum <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li role="presentation"><a href="/conta/forum/novo">Abrir nova discussão</a></li>
            <li role="presentation"><a href="/conta/forum/listar">Listar minhas discussões</a></li>
        </ul>
    </li>
    <?php } ?>
    
    <?php if(defined('Settings::PIER_ELEARN') && Settings::PIER_ELEARN){ ?>
    <li role="presentation" class="dropdown <?php if($menu_conta_active == 'elearn') echo "active"; ?>">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Elearn <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li role="presentation"><a href="/conta/elearn/listar">Meus Cursos</a></li>
            <li role="presentation"><a href="/conta/elearn/duvidas">Minhas Dúvidas</a></li>
        </ul>
    </li>
    <?php } ?>
    
    <?php if(defined('Settings::PIER_ORCAMENTUS') && Settings::PIER_ORCAMENTUS){ ?>
    <li role="presentation" class="dropdown <?php if($menu_conta_active == 'orcamentus') echo "active"; ?>">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Orcamentus <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li role="presentation"><a href="/conta/orcamentus/novo">Abrir nova cotação</a></li>
            <li role="presentation"><a href="/conta/orcamentus/minhas_cotacoes">Listar minhas cotações</a></li>
            <li role="presentation"><a href="/conta/orcamentus/minhas_propostas">Listar minhas propostas</a></li>
        </ul>
    </li>
    <?php } ?>
    <?php if(defined('Settings::PIER_COMUNICATOR') && Settings::PIER_COMUNICATOR){ ?>
    <li role="presentation"><a href="#" data-toggle="modal" data-target="#piercommunicator">Comunicador</a></li>
    <?php } ?>
    
    <li role="presentation"><a href="/conta/sair">Sair</a></li>
</ul>

