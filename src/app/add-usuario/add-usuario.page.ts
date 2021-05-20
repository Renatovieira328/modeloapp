import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { PostService } from 'src/service/post.service';

@Component({
  selector: 'app-add-usuario',
  templateUrl: './add-usuario.page.html',
  styleUrls: ['./add-usuario.page.scss'],
})
export class AddUsuarioPage implements OnInit {
  id: string = "";
  nome: string = "";
  email: string = "";
  telefone: string = "";
  cidade: string = "";
  cpf: string = "";

  constructor(private service: PostService, private router: Router, private actRoute: ActivatedRoute) { }

  ngOnInit() {
    this.actRoute.params.subscribe((dadosdarota: any) => {
      this.id = dadosdarota.id;
      this.nome = dadosdarota.nome;
      this.email = dadosdarota.email;
      this.telefone = dadosdarota.telefone;
      this.cidade = dadosdarota.cidade
      this.cpf = dadosdarota.cpf
    })
  }

  cadastrar() {
    let usuario = {
      id: this.id,
      nome: this.nome,
      email: this.email,
      telefone: this.telefone,
      cidade: this.cidade,
      cpf: this.cpf
    };
    this.service.dadosApi(usuario, "api.php").subscribe(data => {
      console.log(data);
    })
  }
}