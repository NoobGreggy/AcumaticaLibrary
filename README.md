# Acumatica Library for PHP

## Description

This is a personal use to implement a transaction to ACUMATICA ERP Web Service Endpoint Hope it will help.

## Getting Started

### Dependencies

* Need php 7.8+

### Installing
* composer require acumaticalibrary/noobgrammer:master-dev

### Executing program

* How to run the program
* Step-by-step bullets
```
 $datafield = [
          "CustomerID" => [ "value" => "#"],
          "CustomerName" => [ "value" => "#"],
          "CustomerClass" => [ "value" => "INDVS"],
          "Status" => [ "value" => "#"],
          "StatementCycleID" => [ "value" => '#'],
          "FinancingDimensionCustomer" => [ "value" => true],
          "CashDiscountAccount" => [ "value" => "#"],
          "CashDiscountSub" => [ "value" => "#"],
          "ARAccount" => [ "value" => "#"],
          "ARSub" => [ "value" => "#"],
          "SalesAccount" => [ "value" => "#"],
          "SalesSub" => [ "value" => "#"],
          'MainContact' => [
                'CompanyName' => [ "value" => "#"],
                'DisplayName'=>   [ "value" => "#"],
                'FirstName'=> [ "value" => "#"],
                "LastName" => [ "value" => "#"],
                "DateofBirth" => [ "value" => "#"],
                "Phone1" => [ "value" => "#"],
                "Calendar" => [ "value" => "#"],
                "AddressLine2" => [ "value" => "#"],
                "AddressLine1" => [ "value" => "#"],
                "City" => [ "value" => "#"],
                "State" => [ "value" => "#"],
                "Country" => [ "value" => "#"]
            ]
        ];

        $requestData = [
            'acumaticaLoginEndPoint' => '#',
            'acumaticaLogoutEndPoint' => '#',
            'Login_Acumatica' => [
               			 'name' => 'yourUsername',
				'password'=> 'yourPassword',
				'tenant'=> 'yourtenant',
				"branch" => '',
				"locale" => ""
            ],
            'Body_Acumatica' =>[
               'Action' => 'PUT', 
               'URL' => 'YourAcumaticaEndPoint',
               'data' => $datafield
            ]
        ];


     return json_encode($this->acumatica->acumatica_Api($requestData));

   Access for The Odata

   1.) Go to your Generic Inquiry and Create a Generic Inquiry
   2.) after create a Generic Inquiry tick the odata  then update
   3. go to your php app and use this. 

      $url = '#';

      $odataServices = [
        'URL' => 'YourAcumaticaEndPoint',
        'name' => 'yourUsername',
        'password'=> 'yourPassword',
      ];
		
       return  $this->acumatica->odataParse($url);
```
## Version History
* 0.1
    * Initial Release

## License

This project is licensed under the Greggy License - see the LICENSE.md file for details

## Acknowledgments

Inspiration, code snippets, etc.
* [Guzzle](https://github.com/guzzle/guzzle)
