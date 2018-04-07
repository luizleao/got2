(function($){
	  $(function(){
	    $('select').material_select();
	    $(".dropdown-button").dropdown({
	    	inDuration: 300,
	        outDuration: 225,
	        constrainWidth: false, // Does not change width of dropdown to that of the activator
	        hover: false, // Activate on hover
	        gutter: 0, // Spacing from edge
	        belowOrigin: true, // Displays dropdown below the button
	        alignment: 'left', // Displays dropdown with edge aligned to the left of button
	        stopPropagation: false // Stops event propagation
	    });
	    $('.button-collapse').sideNav({
	        menuWidth: 300, // Default is 300
	        edge: 'left', // Choose the horizontal origin
	        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
	        draggable: true, // Choose whether you can drag to open on touch screens,
	        onOpen: function(el) { /* Do Stuff */ }, // A function to be called when sideNav is opened
	        onClose: function(el) { /* Do Stuff */ }, // A function to be called when sideNav is closed
	      }
	    );
	    $('.datepicker').pickadate({
	    	monthsFull:    ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
	        monthsShort:   ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
	        weekdaysFull:  ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
	        weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
	        today: 'Hoje',
	        clear: 'Limpar',
	        close: 'Ok',
	        labelMonthNext: 'Próximo mês',
	        labelMonthPrev: 'Mês anterior',
	        labelMonthSelect: 'Selecione um mês',
	        labelYearSelect: 'Selecione um ano',
	        format: 'dd/mm/yyyy',
	    	selectMonths: true, // Creates a dropdown to control month
	        selectYears: 15, // Creates a dropdown of 15 years to control year,
	        closeOnSelect: true, // Close upon selecting a date,
	        onClose: function() {
	        	$(document.activeElement).blur()
	        }
	      });
	    $('.timepicker').pickatime({
		    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
		    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
		    twelvehour: false, // Use AM/PM or 24-hour format
		    donetext: 'OK', // text for done-button
		    cleartext: 'Clear', // text for clear-button
		    canceltext: 'Cancel', // Text for cancel-button
		    autoclose: false, // automatic close timepicker
		    ampmclickable: true, // make AM PM clickable
		    aftershow: function(){} //Function for after opening timepicker
	  });
	  }); // end of document ready
	})(jQuery); // end of jQuery name space