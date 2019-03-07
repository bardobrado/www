class Game{
   
    constructor(){
        var constfeig = 4.669201609;
        var renderer = new THREE.WebGLRenderer();

        renderer.setSize( window.innerWidth, window.innerHeight );
        document.body.appendChild( renderer.domElement );

        var camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 500 );
        camera.position.set( 0, 0, 100 );
        camera.lookAt( 0, 0, 0 );

        var scene = new THREE.Scene();

        var material = new THREE.LineBasicMaterial( { color: 0x0000ff } );

        
       
        var horizon2 = new THREE.Geometry();
        

        for ( var divisoes = 1; divisoes < innerHeight.valueOf(); divisoes*10) {
           
            linhapersp = innerHeight.valueOf() + divisoes;
            
            horizon2.vertices.push(new THREE.Vector3( (0-innerWidth), 0, 0) );
            horizon2.vertices.push(new THREE.Vector3( (0+innerWidth), 0 , 0) );
            horizon2.vertices.push(new THREE.Vector3( linhapersp, 0, 0) );
            

            var line2 = new THREE.line(horizon2, material);
            scene.add( line2 );
        
        }
        
        
        var horizon = new THREE.Geometry();
        
        horizon.vertices.push(new THREE.Vector3( (0-innerWidth), 0, 0) );
        horizon.vertices.push(new THREE.Vector3( (0+innerWidth), 0 , 0) );
        horizon.vertices.push(new THREE.Vector3( innerHeight, 0, 0) );
        


        var line = new THREE.Line( horizon, material );
        scene.add( line );
        
        renderer.render( scene, camera );
    }
    
}