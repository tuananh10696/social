var adOffset, adSize, winH;
// $(window).on('load resize',function(){
//     adOffset = $('#blockWork').offset().top;
//     winH = $(window).height();
// });

var sortable_option = {
	items: 'div.first-dir',
	placeholder: 'ui-state-highlight',
	opacity: 0.7,
	handle: 'div.sort_handle2',
	connectWith: '.list_table_sub',
	update: function ( e, obj )
	{

	}
};

var sortable_option_sub = {
	items: 'div.first-dir',
	placeholder: 'ui-state-highlight',
	opacity: 0.7,
	handle: 'div.sort_handle2',
	connectWith: '.list_table, .list_table_sub',
	receive: function ( e, obj )
	{
		var waku_block_type = $( this ).data( 'wakuBlockType' );
		var section_no = $( this ).closest( '.editor__table' ).data( 'sectionNo' );
		Object.keys( out_waku_list ).forEach( function ( k )
		{
			if ( waku_block_type == k )
			{
				for ( let i in out_waku_list[ k ] )
				{
					if ( $( obj.item[ '0' ] ).find( 'input.block_type' ).val() == out_waku_list[ k ][ i ] )
					{
						if ( obj.sender !== null )
						{
							$( obj.sender[ 0 ] ).sortable( 'cancel' );
						}
						return false;
					}
				}
			}
		} );
	},
	update: function ( e, obj )
	{
		var section_no = $( obj.item[ '0' ] ).closest( '.editor__table' ).data( 'sectionNo' );
		console.log( section_no );
		if ( typeof section_no !== 'undefined' )
		{
			var waku_block_type = $( obj.item[ '0' ].closest( '.editor__table' ) ).data( 'blockType' );
			$( obj.item[ '0' ] ).find( 'input.section_no' ).val( section_no );
		} else if ( obj.sender == null )
		{
			$( obj.item[ '0' ] ).find( 'input.section_no' ).val( 0 );
		}
	}
};

var sortable_option_relation = {
	items: 'div.relation-dir',
	placeholder: 'ui-state-highlight',
	opacity: 0.7,
	handle: 'div.sort_handle2',
	receive: function ( e, obj )
	{
		var waku_block_type = $( this ).data( 'wakuBlockType' );
		var section_no = $( this ).closest( '.editor__table' ).data( 'sectionNo' );
		Object.keys( out_waku_list ).forEach( function ( k )
		{
			if ( waku_block_type == k )
			{
				for ( let i in out_waku_list[ k ] )
				{
					if ( $( obj.item[ '0' ] ).find( 'input.block_type' ).val() == out_waku_list[ k ][ i ] )
					{
						if ( obj.sender !== null )
						{
							$( obj.sender[ 0 ] ).sortable( 'cancel' );
						}
						return false;
					}
				}
			}
		} );
	},
	update: function ( e, obj )
	{

	}
};

function addTag ( tag )
{
	var url = '/user_admin/infos/add_tag';
	var params = {
		'num': tag_num,
		'tag': tag
	};

	$.post( url, params, function ( a )
	{
		$( "#tagArea" ).append( a );
		tag_num++;
	} );
}

function addBlock ( type, e )
{
	var url = '/user_admin/infos/add_row';
	var slug = $( e ).attr( 'data-slug' );
	var info_id = $( e ).attr( 'data-info_id' ) || 0;

	var params = {
		'rownum': rownum,
		'block_type': type,
		'slug': slug,
		'info_id': info_id,
		'_csrfToken': $( 'input[name="_csrfToken"]' ).val(),
	};
	if ( rownum >= max_row )
	{
		alert_dlg( `追加できるブロックは${ max_row }件までです。` );
		return;
	}
	$.post( url, params, function ( a )
	{
		$( "#blockArea" ).append( a );
		if ( type == 2 || type == 11 || type == 22 || type == 26 )
		{
			$( `#block_no_${ rownum } textarea.editor` ).each( function ()
			{
				var _id = $( this ).attr( 'id' );
				setWysiwyg( `#${ _id }`, page_config_slug );
			} );
		}

		if ( type == 13 )
		{
			$( `#block_no_${ rownum } .list_table_relation` ).sortable( sortable_option_relation );
		}
		else if ( type in block_type_waku_list !== false )
		{
			$( `#block_no_${ rownum } .list_table_sub` ).sortable( sortable_option_sub );
		}

		rownum++;

	} );
}

// 関連記事枠の関連記事　専用
function addBlockRelation ( waku_no, section_no )
{
	var type = block_type_relation;
	var url = '/user_admin/infos/add_row';
	var params = {
		'rownum': rownum,
		'block_type': type,
		'section_no': section_no
	};

	if ( rownum >= max_row )
	{
		alert_dlg( `追加できるブロックは${ max_row }件までです。` );
		return;
	}
	$.post( url, params, function ( a )
	{
		$( `#block_no_${ waku_no } .list_table_relation` ).append( a );

		rownum++;
	} );
}

function changeStyle ( elm, rownum, target_class, target_name )
{
	var class_name = $( elm ).val();

	$( `#block_no_${ rownum } .${ target_class }` ).removeClass( function ( index, className )
	{
		var match = new RegExp( "\\b" + target_name + "\\S+", "g" );
		return ( className.match( match ) || [] ).join( ' ' );
	} );

	if ( class_name != "" )
	{
		if ( class_name.match( /^[0-9]+$/ ) )
		{
			class_name = target_name + class_name;
		}
		$( `#block_no_${ rownum } .${ target_class }` ).addClass( class_name );
	}

	var type = $( elm ).closest( 'tbody.list_table_sub' ).data( 'wakuBlockType' );
	if ( type in block_type_waku_list !== false )
	{
		if ( class_name == 'waku_style_6' )
		{
			$( `#block_no_${ rownum } .optionValue3` ).attr( 'disabled', true );
			$( `#block_no_${ rownum } .optionValue3` ).val( '' );
		} else
		{
			// $(`#block_no_${rownum} .optionValue2`).attr('disabled', false);
			$( `#block_no_${ rownum } .optionValue3` ).attr( 'disabled', false );
		}
	}
}

function changeSelectStyle ( elm, rownum )
{
	var style = $( elm ).val();
	// console.log(style);
	if ( style == 'waku_style_6' )
	{
		$( "#idWakuColorCol_" + rownum ).hide();
		$( "#idWakuColorCol_" + rownum + ' select' ).attr( "disabled", true );
		$( "#idWakuBgColorCol_" + rownum ).show();
		$( "#idWakuBgColorCol_" + rownum + ' select' ).attr( "disabled", false );
	} else
	{
		$( "#idWakuBgColorCol_" + rownum ).hide();
		$( "#idWakuBgColorCol_" + rownum + ' select' ).attr( "disabled", true );
		$( "#idWakuColorCol_" + rownum ).show();
		$( "#idWakuColorCol_" + rownum + ' select' ).attr( "disabled", false );
	}
}

function changeWidth ( elm, rownum, target_class, name )
{
	var num = $( elm ).val();

	if ( num > 0 )
	{
		$( `#block_no_${ rownum } .${ target_class }` ).css( name, `${ num }px` );
	} else
	{
		$( `#block_no_${ rownum } .${ target_class }` ).css( name, `` );
		num = '';
		$( elm ).val( num );
	}
}

function changeButtonName ( elm )
{
	var row = $( elm ).data( "row" );
	$( "#idButtonTitle_" + row ).html( $( elm ).val() );
}

function changeButtonColor ( elm )
{
	var row = $( elm ).data( 'row' );
	var btn = $( "#idButtonTitle_" + row );

	btn.removeClass( 'btn-primary' );
	btn.removeClass( function ( index, className )
	{
		return ( className.match( /\bbutton_color_\S+/g ) || [] ).join( ' ' );
	} );
	btn.addClass( $( elm ).val() );

}

function changeFileName ( elm, row )
{
	var name_block = $( "#block_no_" + row ).find( '.result > span' );
	name_block.text( $( elm ).val() );
}

function clickSort ( row, mode )
{
	var item = $( "#block_no_" + row );
	var section_no = item.find( '.section_no' ).val();
	var wakuId = '#wakuId_' + section_no;
	if ( section_no == 0 )
	{
		wakuId = '#blockArea';
	}

	if ( mode == 'up' )
	{
		item.prev().before( item );
	} else if ( mode == 'down' )
	{
		item.next().after( item );
	} else if ( mode == 'first' )
	{
		$( wakuId + ' .item_block:first' ).before( item );
	} else if ( mode == 'last' )
	{
		$( wakuId ).append( item );
	}
}

function clickItemConfig ( elm )
{
	var section_no = $( elm ).closest( '.item_block' ).find( '.section_no' ).val();
	var wakuId = '#wakuId_' + section_no;
	if ( section_no == 0 )
	{
		wakuId = '#blockArea';
	}

	var type = $( elm ).closest( '.item_block' ).find( '.block_type' ).val();
	if ( type in block_type_waku_list !== false )
	{
		wakuId = '#blockArea';
	}

	// 枠内の最初
	if ( $( wakuId ).find( '> .item_block:first' ).attr( 'id' ) == $( elm ).closest( '.item_block' ).attr( 'id' ) )
	{
		$( elm ).next().find( '.up' ).hide();
	} else
	{
		$( elm ).next().find( '.up' ).show();
	}

	// 枠内の最後
	if ( $( wakuId ).find( '> .item_block:last' ).attr( 'id' ) == $( elm ).closest( '.item_block' ).attr( 'id' ) )
	{
		$( elm ).next().find( '.down' ).hide();
	} else
	{
		$( elm ).next().find( '.down' ).show();
	}
}


function addBoxChat ( e )
{
	var boxChat = $( '#default_temp .box_chat' ).clone();
	var chatContent = $( e ).parents( '.box-btn-chat' ).siblings( '.box-chat-content' ).find( '.chat-content' );
	var boxChats = chatContent.find( '.box_chat' );
	var tableRow = $( e ).parents( '.table__row' );

	boxChat.attr( 'id', `box_chat_${ boxChats.length }` );

	boxChat.find( 'select' )
		.attr( 'name', `info_contents[${ tableRow.find( '._block_no' ).val() }][member_chat][${ boxChats.length }][member_id]` );
	boxChat.find( 'textarea' )
		.attr( 'name', `info_contents[${ tableRow.find( '._block_no' ).val() }][member_chat][${ boxChats.length }][content]` );

	chatContent.append( boxChat );
	// setWysiwyg(`#${tableRow.attr('id')} #box_chat_${boxChats.length} textarea.editor`);
}


function changeMember ( e )
{
	var idMember = $( e ).val(),
		boxChat = $( e ).parents( '.box_chat' );
	boxEnterContentChat = boxChat.find( '.box-enter-content-chat' );

	boxChat.attr( 'data-member_id', idMember );

	var chatContent = $( e ).parents( '.chat-content' );
	setPostionChatBox( chatContent );
}


function setPostionChatBox ( chatContent )
{
	var img_pos_left = true;
	var count = 0;
	var member_id = 0;

	chatContent.find( '.box_chat' ).each( function ()
	{
		var _t = $( this ),
			mid = _t.attr( 'data-member_id' ),
			boxAvata = _t.find( '.box-avata' ),
			boxAvataLeft = _t.find( '.box-avata-left' ),
			boxAvataRight = _t.find( '.box-avata-right' ),
			boxEnterContentChat = _t.find( '.box-enter-content-chat' );

		boxAvata.addClass( 'dpl_none' )
			.find( 'img' )
			.addClass( 'dpl_none' );

		boxEnterContentChat.addClass( 'dpl_none' );

		if ( parseInt( mid ) == 0 ) return true;

		if ( count != 0 && parseInt( mid ) != parseInt( member_id ) )
			img_pos_left = !img_pos_left;

		boxAvata = img_pos_left ? boxAvataLeft : boxAvataRight;
		boxAvata.removeClass( 'dpl_none' )
			.find( `img.avata-${ mid }` ).removeClass( 'dpl_none' );

		boxEnterContentChat.removeClass( 'dpl_none' );

		member_id = mid;
		count++;

	} );
}


function getMeta ( url, callback )
{
	const img = new Image();
	img.src = url;
	img.onload = function () { callback( this.width, this.height ); }
}



function getFileSize ( e )
{

	var files = $( e )[ 0 ].files;

	var is_file_size = false;
	var total = 0;

	for ( let i = 0; i < files.length; i++ )
	{
		const __size = files[ i ]?.size || 0;

		if ( __size > max_file_size )
		{
			is_file_size = true;
			break;
		}

		total += __size;
	}

	if ( is_file_size )
	{
		alert_dlg( '１ファイルのアップロード出来る容量を超えています' );
		$( e ).val( '' );
		return -1;
	}

	return total;
}


$( function ()
{
	rownum = $( "#idContentCount" ).val();

	// 保存、削除ボタンの固定化
	$( window ).scroll( function ()
	{
		if ( $( this ).scrollTop() > adOffset - winH )
		{
			$( "#editBtnBlock" ).removeClass( 'fixed-bottom' );
			$( "#editBtnBlock" ).removeClass( 'pb-3' );
		} else
		{

			$( "#editBtnBlock" ).addClass( 'fixed-bottom' );
			$( "#editBtnBlock" ).addClass( 'pb-3' );
		}
	} );

	$( "body" ).on( 'change', '.attaches', function ()
	{
		var attaches = document.getElementsByClassName( 'attaches' );
		var form_file_size = 0;
		var ischeck = false;

		for ( var i = 0; i < attaches.length; i++ )
		{
			if ( getFileSize( attaches[ i ] ) == -1 )
			{
				ischeck = true;
				break;
			}

			form_file_size += getFileSize( attaches[ i ] );
		}

		if ( form_file_size > total_max_size )
		{
			$( this ).val( '' );
			alert_dlg( '一度にアップ出来る容量を超えました。一度保存してください' );
			ischeck = true;
		}

		if ( ischeck ) return;

		let elm = this;
		let fileReader = new FileReader();
		fileReader.readAsDataURL( elm.files[ 0 ] );

		let has_oll_img = $( elm )
			.siblings( '.thumbImg' )
			.find( 'input.old_img_input' )
			.length >= 1;

		$( elm )
			.siblings( ".preview_img" )
			.children( 'img' ).remove()

		fileReader.onload = ( function ()
		{
			let imgTag = `<img src='${ fileReader.result }' style='max-width:500px;border:1px solid #e9e9e9'>`

			$( elm )
				.siblings( ".preview_img" )
				.prepend( imgTag )
				.removeClass( 'dpl_none' )
				.find( '.preview_img_btn' )
				.text( has_oll_img ? '元の画像に戻す' : '画像の削除' )
				.attr( 'onclick', `preview_img_action(this, ${ has_oll_img })` );


			$( elm )
				.siblings( '.thumbImg' )
				.addClass( 'dpl_none' );

		} );
	} );


	// 並び替え
	$( ".list_table" ).sortable( sortable_option );
	$( `.list_table_sub` ).sortable( sortable_option_sub );
	$( `.list_table_relation` ).sortable( sortable_option_relation );


	// ブロック削除
	$( 'body #blockArea' ).on( 'click', '.btn_list_delete', function ()
	{
		var row = $( this ).data( "row" );
		$( `#block_no_${ row }` ).addClass( 'delete' );
		toggleDeleteStatus( this, row );
	} );

	// 削除を元に戻す
	$( 'body #blockArea' ).on( 'click', '.btn_list_undo', function ()
	{
		var row = $( this ).data( "row" );
		$( `#block_no_${ row }` ).removeClass( 'delete' );
		toggleDeleteStatus( this, row );
	} );

	// タグ追加
	$( '#btnAddTag' ).on( 'click', function ()
	{
		var tag = $( "#idAddTag" ).val();
		if ( tag != "" )
		{
			addTag( tag );
			$( "#idAddTag" ).val( '' );
		} else
		{
			alert_dlg( 'タグを入力してください' );
		}
		return false;
	} );

	// タグ削除
	$( "#tagArea" ).on( 'click', '.delete_tag', function ()
	{
		var id = $( this ).data( 'id' );
		$( "#tag_id_" + id ).addClass( 'delete' );
		$( "#tag_id_" + id + ' input' ).attr( 'disabled', true );
		$( "#tag_id_" + id + ' a' ).removeClass( 'delete_tag' );
		$( "#tag_id_" + id + ' a' ).addClass( 'delete_rollbak' );
	} );

	// タグ削除取消
	$( "#tagArea" ).on( 'click', '.delete_rollbak', function ()
	{
		var id = $( this ).data( 'id' );
		$( "#tag_id_" + id ).removeClass( 'delete' );
		$( "#tag_id_" + id + ' input' ).attr( 'disabled', false );
		$( "#tag_id_" + id + ' a' ).removeClass( 'delete_rollbak' );
		$( "#tag_id_" + id + ' a' ).addClass( 'delete_tag' );
	} );

	// タグリスト
	$( "#btnListTag" ).on( 'click', function ()
	{
		pop_box.select = function ( tag )
		{
			addTag( tag );
			pop_box.close();
		};

		pop_box.open( {
			element: "#btnListTag",
			href: "/user_admin/infos/pop_taglist?page_config_id=" + page_config_id,
			open: true,
			onComplete: function ()
			{
			},
			onClosed: function ()
			{
				pop_box.remove();
			},
			opacity: 0.5,
			iframe: true,
			width: '900px',
			height: '750px'
		} );

		return false;
	} )

	$( "body" ).on( 'click', '.pop_image_single', function ( e )
	{
		var options = {
			maxWidth: "90%",
			maxHeight: "90%",
			opacith: 0.7,
			open: true,
			html: `<img src="${ $( this ).attr( 'href' ) }"/>`
		};

		getMeta( $( this ).attr( 'href' ), ( w, h ) =>
		{
			pop_box.image_single( { ...options, width: w + 'px', height: h + 'px' } );
		} );
		e.preventDefault();
	} );

	$( "#btnSave" ).on( 'click', function ()
	{
		$( "#idPostMode" ).val( 'save' );
		$( this ).closest( 'form' ).removeAttr( 'target' );
		document.fm.submit();
		return false;
	} );

	// $("#btnPreview").on('click', function() {
	//   $("#idPostMode").val('preview');
	//   $(this).closest('form').attr('target', "_blank");
	//   document.fm.submit();
	//   return false;
	// });

	// ckeditorは一度に複数の指定をできないためループで回す
	$( '.table__row textarea.editor' ).each( function ()
	{
		var _id = $( this ).attr( 'id' );
		setWysiwyg( `#${ _id }`, page_config_slug );
	} );

	// box chat
	$( '.table__row .chat-content' ).each( () => setPostionChatBox( $( this ) ) );
} );