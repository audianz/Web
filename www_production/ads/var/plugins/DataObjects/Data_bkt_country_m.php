<?php

/*
+---------------------------------------------------------------------------+
| OpenX v${RELEASE_MAJOR_MINOR}                                                                |
| =======${RELEASE_MAJOR_MINOR_DOUBLE_UNDERLINE}                                                                |
|                                                                           |
| Copyright (c) 2003-2009 OpenX Limited                                     |
| For contact details, see: http://www.openx.org/                           |
|                                                                           |
| This program is free software; you can redistribute it and/or modify      |
| it under the terms of the GNU General Public License as published by      |
| the Free Software Foundation; either version 2 of the License, or         |
| (at your option) any later version.                                       |
|                                                                           |
| This program is distributed in the hope that it will be useful,           |
| but WITHOUT ANY WARRANTY; without even the implied warranty of            |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
| GNU General Public License for more details.                              |
|                                                                           |
| You should have received a copy of the GNU General Public License         |
| along with this program; if not, write to the Free Software               |
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
+---------------------------------------------------------------------------+
$Id: Data_bkt_country_m.php 32394 2009-02-13 15:30:45Z david.keen $
*/

require_once MAX_PATH.'/lib/max/Dal/DataObjects/DB_DataObjectCommon.php';

/**
 * DB_DataObject for data_bkt_country_m
 *
 * @package    Plugin
 * @subpackage openxDeliveryLogCountry
 */
class DataObjects_Data_bkt_country_m extends DB_DataObjectCommon
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'data_bkt_country_m';              // table name
    public $interval_start;                  // DATETIME() => openads_datetime => 142 
    public $creative_id;                     // MEDIUMINT(20) => openads_mediumint => 129 
    public $zone_id;                         // MEDIUMINT(20) => openads_mediumint => 129 
    public $country;                         // CHAR(3) => openads_char => 130 
    public $count;                           // INT(11) => openads_int => 129 

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Data_bkt_country_m',$k,$v); }

    var $defaultValues = array(
                'interval_start' => '%NO_DATE_TIME%',
                'country' => '',
                'count' => 0,
                );

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}

?>