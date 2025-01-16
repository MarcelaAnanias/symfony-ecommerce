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
            theme: 'material',
            icon: 'fas fa-exclamation-triangle',
            title: 'Are you sure you want to delete?',
            content: 'This is a permanent action and cannot be undone.',
            buttons: {
                Confirm: {
                    btnClass: 'btn-default ',
                    action: function () {
                        window.location.href = url; // Redireciona para a exclusão
                    }
                },
                Cancel: {
                    btnClass: 'btn-confirm',
                    action: function () {
                    }
                }
            }
        });
    });
});

$(document).ready(function () {
    $('.delete-editor').on('click', function (e) {
        e.preventDefault(); // Impede a navegação imediata

        const url = $(this).attr('href'); // Pega o link de exclusão

        // Exibe a confirmação
        $.confirm({
            theme: 'material',
            icon: 'fas fa-exclamation-triangle',
            title: 'Remove Editor Role',
            content: 'Are you sure you want to remove the Editor role from this user?',
            buttons: {
                Confirm: {
                    btnClass: 'btn-default',
                    action: function () {
                        window.location.href = url; // Redireciona para a exclusão
                    }
                },
                Cancel: {
                    btnClass: 'btn-confirm',
                    action: function () {
                    }
                }
            }
        });
    });
});
