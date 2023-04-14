function setWysiwyg ( elm )
{

	ClassicEditor
		.create( document.querySelector( elm ), {
			'alignment': {
				options: [
					{ name: 'left', className: 'text-left' },
					{ name: 'right', className: 'text-right' },
					{ name: 'center', className: 'text-center' }
				]
			},
		} )
		.then( editor =>
		{
			// editor.ui.view.editable.element.style.height = '300px';
		} )
		.catch( error =>
		{
			// console.log(elm);
			console.error( error );
		} );


	return;
}


function chooseFileUpload ( e )
{
	
	var $this = $( e );
	$this.parents( '.td_parent' ).find( '.error-message' ).remove();

	var files = $this[ 0 ].files;
	var types = $this.attr( 'data-type' );
	var types = types.split( "," );

	var is_file_type = false;
	var is_file_size = false;

	for ( let i = 0; i < files.length; i++ )
	{
		const __type = files[ i ].type;
		if ( $.inArray( __type, types ) === -1 )
		{
			is_file_type = true;
			break;
		}
		if ( files[ i ].size > max_file_size )
		{
			is_file_size = true;
			break;
		}

	}
	
	if ( is_file_type || is_file_size )
	{
		var text_error = is_file_type ? '指定されたファイルを選択してください' : 'ファイルサイズ5MB以内';
		$this.parents( '.td_parent' ).append( `<div class="error-message"><div class="error-message">${ text_error }</div></div>` );
		$this.val( '' );
		return false;
	}
}


function preview_img_action ( e, is_back_old_image )
{
	$( e )
		.parents( '.preview_img' )
		.addClass( 'dpl_none' )
		.siblings( 'input' )
		.val( '' )
		.siblings( '.thumbImg' )
		.removeClass( 'dpl_none' );

	if ( is_back_old_image )
		$( e )
			.parents( '.preview_img' )
			.siblings( '.thumbImg' )
			.removeClass( 'dpl_none' );
}


function matchYoutubeUrl ( url )
{
	var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	var matches = url.match( p );
	return matches ? matches[ 1 ] : false;
}


function detectVideo ( e )
{
	var par = $( e ).parents( '.group-video' );
	var videoType = par.find( '.video-type' ).val();

	return videoType == 'youtube' ? getVideoYT( par.find( '.input-video' ) ) : getVideoVimeo( par.find( '.input-video' ) );
}


function getVideoYT ( e )
{
	var inp_val = $( e ).val();
	var par = $( e ).parents( '.group-video' );
	var is_url = par.find( '.is_url' );

	if ( inp_val != '' )
	{
		par.find( '.yt' ).removeClass( 'dpl_none' );

		var id = is_url.is( ':checked' ) ? matchYoutubeUrl( inp_val ) : inp_val;
		var video = `<iframe width="560" height="315" src="https://www.youtube.com/embed/${ id }" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;

		par.find( '.yt' ).html( video );
	} else par.find( '.yt' ).addClass( 'dpl_none' ).html( '' );
}


function getVideoVimeo ( e )
{
	var inp_val = $( e ).val();
	var par = $( e ).parents( '.group-video' );
	var is_url = par.find( '.is_url' );

	if ( inp_val != '' )
	{
		par.find( '.yt' ).removeClass( 'dpl_none' );

		var p = /^(?:http|https)?:?\/?\/?(?:www\.)?(?:player\.)?vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|video\/|)(\d+)(?:|\/\?)$/;
		var matches = inp_val.match( p );

		var id = is_url.is( ':checked' ) ? ( matches ? matches[ 1 ] : 0 ) : inp_val;

		var video = `<iframe src="https://player.vimeo.com/video/${ id }" width="560" height="315" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>`;

		par.find( '.yt' ).html( video );
	} else par.find( '.yt' ).addClass( 'dpl_none' ).html( '' );
}


function toggleDeleteStatus ( e, row )
{
	const block_id = $( `#idBlockId_${ row }` ).val();
	const block_no = $( `#block_no_${ row }` );
	if ( block_id == 0 ) block_no.remove();

	const is_delete = block_no.hasClass( 'delete' );

	block_no.find( 'input, textarea' ).attr( 'readonly', is_delete );
	block_no.find( 'textarea' ).attr( 'readonly', is_delete );
	block_no.find( 'select option:not(:selected)' ).attr( 'disabled', is_delete );

	const click_item = block_no.find( 'input[type="checkbox"], input[type="radio"],input[type="file"]' );

	if ( is_delete ) click_item.attr( 'onclick', 'return false;' );
	else click_item.removeAttr( 'onclick' )

	const undo_class = 'btn_list_undo btn-danger';
	const delete_class = 'btn_list_delete btn-secondary';
	const txt = is_delete ? '元に戻す' : '削除';

	$( e )
		.removeClass( is_delete ? delete_class : undo_class )
		.addClass( is_delete ? undo_class : delete_class )
		.html( txt );

	if ( block_id > 0 )
		if ( is_delete ) $( "#deleteArea" ).append( `<input type="hidden" name="delete_ids[]" value="${ block_id }" id="delBlock_${ block_id }">` );
		else $( `#deleteArea #delBlock_${ block_id }` ).remove();
}