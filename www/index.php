<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Добро пожаловать");
?>
<p>Добро пожаловать на заготовку сайта!</p>
<p><a href="/bitrix/admin/">Control panel</a></p>

<h2>Зачем это нужно?</h2>
<p>@todo: написать здесь текст обо всех преимуществах решения</p>
    <ul>
        <li>Вы получаете среду, основанную на рекомендациях вендора, ведь в качестве окружения используется BitrixEnv!</li>
        <li>У вас "из коробки" работают миграции и консольные команды, основанные на решении console jedi</li>
        <li>"Из коробки" работает composer, с помощью которого можно подключать другие опенсорс-модули для 1С-Битрикс</li>
        <li>Вы можете использовать это решение с Docker, VirtualBox, VMWare и другими платформами <a href="https://www.vagrantup.com/docs/providers/">благодаря vagrant</a></li>
        <li>Не забывайте про больше возможностей vagrant, например, <a href="https://www.vagrantup.com/docs/share/">sharing</a></li>
        <li>В composer.json также прописаны ускоряющие разработку решения <a href="http://bbc.bitrix.expert">bbc</a> и <a href="#">adminhelper</a>, которые ускоряют разработку по-настоящему используя возможности ООП.</li>
    </ul>

<h2>Как это использовать</h2>
PHP Storm / другая IDE
Папка bitrix и git

<h2>Благодарности</h2>
Марат
Игорь

    meet.bitrix.expert

<h2>Что почитать для улучшения навыков</h2>
    https://www.vagrantup.com/docs/
    composer
    видеоуроки на ютубе
    статьи Ника про консольный джедай
    meet.bitrix.expert

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>