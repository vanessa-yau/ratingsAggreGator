var $listSelection = $('.dropdown-list-selection i');
	
			// Change button text depending on selected dropdown list item
			$('#dropdown-all').click(function(e){
				e.preventDefault();
				if( $('.dropItem').hasClass('active') ){
					$('.dropItem').removeClass('active');
				}
				$('#dropdown-all').addClass('active');
				$listSelection.text('All Wish Lists ');

				$('.thumbnail').each(function() {
					$(this).parents('.list-container').toggle(true);
				});
			});

			$('#dropdown-admin').click(function(e){
				e.preventDefault();
				if( $('.dropItem').hasClass('active') ){
					$('.dropItem').removeClass('active');
				}
				$('#dropdown-admin').addClass('active');
				$listSelection.text('As Administrator ');

				$('.thumbnail').each(function() {
					var $role = $(this).data('role');
					
					if( $role == 'collaborator' ){
						$(this).parents('.list-container').toggle(false);
					}
					
					if( $role == 'admin' ){
						$(this).parents('.list-container').toggle(true);	
					}
				});
			});

			$('#dropdown-collaborator').click(function(e){
				e.preventDefault();
				if( $('.dropItem').hasClass('active') ){
					$('.dropItem').removeClass('active');
				}
				$('#dropdown-collaborator').addClass('active');
				$listSelection.text('As Collaborator ');

				$('.thumbnail').each(function() {
					var $role = $(this).data('role');
					
					if( $role == 'collaborator' ){
						$(this).parents('.list-container').toggle(true);
					}

					if( $role == 'admin' ){
						$(this).parents('.list-container').toggle(false);	
					}
				});
			});				