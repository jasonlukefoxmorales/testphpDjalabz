<?php 

class Car {

    // Propriétés d'une classe 

    private $brand;

    public $color;

    public $year;
    // Méthode de type de construct cad qu'elle est appelléer automatiquement,
    // Je code une classe enfant / fille convertible qui hérite des propriétés et des méthodes de Car 
    // A une seule condition cependant : que la portée des propriétés et des méthodes de Car() 

    // A une seule condition cependant 


}


/// On va coder une classse user avec les propritétés 
//- Name 
//- Age 
//- Gender 
//  - Money 

// Ces propriétés  seront publiques. Et on va avoir une méthode. sayHello() qui retourne une phrase du type. 
// " Bonjour je suis ... Le nom... et j'ai... age..... Je suis .... " 

// Autre méthode spendMoney() on veut que cette méthode prenne un paramètre qui soit un entier. Le chiffre donné en paramètre devra être retiré du montant de Money. Si jamais nôtre montant Money devient négatif, on affiche 

// Une phrase de type : "Vous n'avez plus d'argent bon courage" . 

// Qqes étapes : 

//- On crée de la classe 
//- on crée les propriétés 
//- On créé la fonction de type_construct
//- On code les méthodes 

//-On instancie bet on vérifie que tout est okay.

<?php
class User 
{
    // déclaration d'une propriété
    public string $name = 'Name';
    public $birthdate = 'Age';
    public $Gender = 'Gender';
    public $Money = 'Money';

    public function_construct($name, $birthdate, $gender, $money) 
    $this ->name = $name; 
    $this ->birthdate = $birthdate;  
    $this ->gender = $gender;
    $this->money = $money; 
} 

public function 

    sayhello() 
    // Opérateur ternaire cad un if .. else écrit différement : (condition) ? si true : si false 

    $ne =$this->gender =='homme' ? 'né' : 'née';
    // if ($this->gender =='homme') {
        // $ne = "né"; 
        // }elese
         //    $ne = "née";
       //  }
    

       $picsou = new User('Picsou', '12 Octobre 1830','homme', 200);
       $goldie = new User('Goldie', '13 Aout 1995', )


    // déclaration des méthodes
    public function displayVar() {
        echo $this->var;

    }
}
?>