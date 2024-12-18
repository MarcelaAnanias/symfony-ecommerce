/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import $ from 'jquery';
import 'jquery-confirm'; 
import 'jquery-confirm/css/jquery-confirm.css'; 

$(document).ready(function () {
    $('.delete-link').on('click', function (e) {
        e.preventDefault(); // Impede a navegação imediata

        const url = $(this).attr('href'); // Pega o link de exclusão

        // Exibe a confirmação
        $.confirm({
            title: 'Tem certeza que deseja excluir?',
            content: 'Essa é uma ação permanente e não poderá ser desfeita.',
            buttons: {
                Confirmar: {
                    btnClass: 'btn-dark',
                    action: function () {
                        window.location.href = url; // Redireciona para a exclusão
                    }
                },
                Cancelar: {
                    btnClass: 'btn-red',
                    action: function () {
                    }
                }
            }
        });
    });
});
