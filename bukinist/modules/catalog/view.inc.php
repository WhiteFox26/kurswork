<?php
class Catalog_View
{
    public static function listView()
    {
        Core::SetMainContent('templates/modules/catalog/catalog.tpl.php');
    }

    public static function AddBookView()
    {
        Core::SetMainContent('templates/modules/catalog/addBook.tpl.php');
    }

    public static function BookInfoView()
    {

        Core::SetMainContent('templates/modules/items/item.tpl.php');
    }
    //EditBookView
    public static function EditBookView()
    {
       Core::SetMainContent('templates/modules/catalog/editBook.tpl.php');
    }
    //
}