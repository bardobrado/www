document.addEventListener( 'mousedown', onDocumentMouseDown, false );

var projector = new THREE.Projector();

function onDocumentMouseDown( event ) {

    event.preventDefault();

    var vector = new THREE.Vector3(
        ( event.clientX / window.innerWidth ) * 2 - 1,
      - ( event.clientY / window.innerHeight ) * 2 + 1,
        0.5
    );
    projector.unprojectVector( vector, camera );

    var ray = new THREE.Ray( camera.position, 
                             vector.subSelf( camera.position ).normalize() );

    var intersects = ray.intersectObjects( objects );

    if ( intersects.length > 0 ) {

        intersects[ 0 ].object.materials[ 0 ].color.setHex( Math.random() * 0xffffff );

        var particle = new THREE.Particle( particleMaterial );
        particle.position = intersects[ 0 ].point;
        particle.scale.x = particle.scale.y = 8;
        scene.add( particle );

    }

    /*
    // Parse all the faces
    for ( var i in intersects ) {
        intersects[ i ].face.material[ 0 ].color
            .setHex( Math.random() * 0xffffff | 0x80000000 );
    }
    */
}