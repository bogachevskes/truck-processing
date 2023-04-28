<?php

namespace app;

enum ProductTypes: string
{
    case TYPE_TROPICAL_OILS = 'Тропические масла';
    
    case TYPE_SPICES = 'Специи';

    case TYPE_CHEESE_POWDER = 'Сырный порошок';

    case PROTECTED_PROTEINS = 'Защищенные белки';
}