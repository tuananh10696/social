function triggerInput ( element, event )
{
    if ( event.target.className === 'multiple-uploader' || event.target.className === 'mup-msg' || event.target.className === 'mup-main-msg' )
        $( element ).find( '._image_' ).click();
}

function previewImage ( element )
{
    const files = $( element )[ 0 ].files;
    const mui = $( element ).parents( '.multiple-uploader' );
    const current_items = mui.find( '.image-container' );
    const __image__ = $( element ).siblings( '.__image__' )[ 0 ];

    const image_container = $( `
        <div class="image-container">
            <label onclick="deleteImgLabel(this)" for="deleteImg_0">x</label>
            <div class="thumbImg">
                <a href="" class="pop_image_single">
                    <img src="" class="image-preview" />
                </a>
            </div>
        </div>
    `);

    if ( files.length == 0 ) return false;

    if ( current_items.length + files.length > 1 )
    {
        alert_dlg( '1ファイルまでです' );
        return false
    }

    mui.find( '.mup-msg' ).addClass( 'd-none' );

    const dt = new DataTransfer();
    for ( const [ index, file ] of Object.entries( __image__.files ) )
        dt.items.add( file );

    for ( let index = 0; index < files.length; index++ )
    {
        const file = files[ index ];
        const item = image_container.clone();

        item.attr( 'data-pos', index + current_items.length );
        item
            .find( 'a' )
            .attr( 'href', URL.createObjectURL( file ) )
            .find( 'img' )
            .attr( 'src', URL.createObjectURL( file ) );

        mui.append( item );

        dt.items.add( file );
    }

    __image__.files = dt.files;
    $( element )[ 0 ].value = [];
}


function deleteImgLabel ( e )
{
    const _parent = $( e ).parents( '.multiple-uploader' );
    const par = $( e ).parents( '.image-container' );
    const old_img = _parent.find( 'input[name="delete_ids_multi_image[]"]' );
    const numrow = _parent.attr( 'data-numrow' );

    const dt = new DataTransfer();
    const __image__ = _parent.find( '.__image__' )[ 0 ];
    const inputId = $( e ).attr( 'for' );

    $( `#${ inputId }` ).attr( 'checked', 'checked' );

    for ( const [ index, file ] of Object.entries( __image__.files ) )
        if ( parseInt( par.attr( 'data-pos' ) ) - old_img.length != index )
            dt.items.add( file )

    __image__.files = dt.files;

    par.remove();

    _parent.find( '.image-container' ).each( function ( i )
    {
        $( this ).attr( 'data-pos', i );
        $( this ).find( '.old_img' ).attr( 'name', `info_contents[${ numrow }][multi_images][${ i }][_old_image]` );
        $( this ).find( '.old_img_id' ).attr( 'name', `info_contents[${ numrow }][multi_images][${ i }][id]` );
    } );

    if ( _parent.find( '.image-container' ).length == 0 ) _parent.find( '.mup-msg' ).removeClass( 'd-none' );
}
