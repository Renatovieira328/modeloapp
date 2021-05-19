import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-add-usuario',
  templateUrl: './add-usuario.page.html',
  styleUrls: ['./add-usuario.page.scss'],
})
export class AddUsuarioPage implements OnInit {
id:string="0";
nome:string="";
email:string='';
telefone:string="";
cidade:string="";
cpf:string="";
  constructor() { }

  ngOnInit() {
  }

  cadastrar(){
    let usuario = {
      id:this.id,
      nome:this.nome,
      email:this.email,
      telefone:this.telefone,
      cidade:this.cidade,
      cpf:this.cpf
    };
    console.log(usuario);
  }
}
