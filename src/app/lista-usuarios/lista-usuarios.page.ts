import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-lista-usuarios',
  templateUrl: './lista-usuarios.page.html',
  styleUrls: ['./lista-usuarios.page.scss'],
})
export class ListaUsuariosPage implements OnInit {

  constructor(private router:Router) { }

  ngOnInit() {
  }
    addusuario() {
      this.router.navigate([('add-usuario')]);
    }
}
