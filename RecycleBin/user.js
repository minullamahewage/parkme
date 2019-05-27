function submitDetails(){
    this.email = document.getElementById("emailID").value;
    this.name = document.getElementById("nameID").value;
    this.password = document.getElementById("passwordID").value;
    console.log(email, name, password);
    var user1 = new User(name,email,password);
    console.log(user1.getName());
}
class User{
    constructor(name, email, password){
        var name=name;
        var email = email;
        var password=password;
    }
    getName(){
        return this.name;
    }
}
