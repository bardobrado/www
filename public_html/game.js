class Game {
    
    constructor() {
        if ( ! Detector.webgl ) Detector.addGetWebGLMessage();
		
		this.container;
		this.player = { };
		this.stats;
		this.controls;
		this.camera;
		this.scene;
        this.renderer;
        
		this.container = document.createElement( 'div' );
		this.container.style.height = '100%';
        document.body.appendChild( this.container );
        
		const game = this;

		this.clock = new THREE.Clock();
        
        this.init();
        
        game.animate();

		window.onError = function(error){
			console.error(JSON.stringify(error));
		}
	}
	
	init() {
   

		this.camera = new THREE.PerspectiveCamera( 70, window.innerWidth / window.innerHeight, 1, 1000 );
        this.camera.position.set(0, window.innerWidth/15, 300);
        this.camera.lookAt( 0, 0, 0 );

		this.scene = new THREE.Scene();
		this.scene.background = new THREE.Color( 0x666666);
		this.scene.fog = new THREE.Fog( 0x000000, 200, 400 );

		let light = new THREE.HemisphereLight( 0xffffff, 0x444444 );
		light.position.set( 0, 200, 0 );
		this.scene.add( light );

		light = new THREE.DirectionalLight( 0xffffff );
		light.position.set( 0, 200, 100 );
		light.castShadow = true;
		light.shadow.camera.top = 180;
		light.shadow.camera.bottom = -100;
		light.shadow.camera.left = -120;
		light.shadow.camera.right = 120;
		this.scene.add( light );
        
        //grid
        var divisions1 = 5;
        var size1w = window.innerWidth/5;
        var sizew = size1w || 10;
        var divisions = divisions1 || 10;
        var step = sizew / divisions;
        var halfSize = sizew / 2;
  
        var vertices = [];
        var scale = 1.77;
        var material1 = new THREE.LineBasicMaterial( {color: 0xa0a0a0, opacity: 0.7, side: THREE.DoubleSide} );
        material1.transparent = true;
        var material3 = new THREE.LineBasicMaterial( {color: 0x993399} );
        var meshlinematerial = new MeshLineMaterial({color: 0x993399, linewidth: 5});

        
        for ( var i = 0, j = 0, k = - halfSize; i <= divisions; i ++, k += step ) {
            // vertices.push( - halfSize , 0, k, halfSize , 0, k );
            // vertices.push( k, 0, - halfSize , k, 0, halfSize  );

            var v = new THREE.Vector3(- halfSize-1   , 0.1, k * scale );
            var v0 = new THREE.Vector3(  halfSize +1 , 0.1, k* scale );
            var v1 = new THREE.Vector3(  k  , 0.1, -halfSize* scale  );
            var v2 = new THREE.Vector3(   k  , 0.1,halfSize* scale );

           
            var geometry3 = new THREE.Geometry();

            var geometry4 = new THREE.Geometry();    
            geometry3.vertices.push(v);
            geometry3.vertices.push(v0);
            geometry4.vertices.push(v1);
            geometry4.vertices.push(v2);
            
            var line = new MeshLine();
            line.setGeometry (geometry3, function( p ) { return 2; });
            var mesh0 = new THREE.Mesh(line.geometry, meshlinematerial);
            this.scene.add(mesh0);

            var line2 = new MeshLine();
            line2.setGeometry (geometry4, function( p ) { return 2; });
            var mesh1 = new THREE.Mesh(line2.geometry, meshlinematerial);
            this.scene.add(mesh1);


            
            for (var m = 0; m < divisions ; m++) {
                if (i < divisions) {
                    
                    var mesh = new THREE.Mesh( new THREE.PlaneBufferGeometry( step, step*scale ), material1 );
                    mesh.name = "mesh" + j;
                    mesh.rotation.x = - Math.PI / 2;
                    mesh.position.x =  (halfSize - step/2)+ i* ( - step )   ;
                    mesh.position.z = (halfSize - step/2) * scale+ m* ( - step)* scale  ;
                    mesh.receiveShadow = true;
     
                    this.scene.add( mesh );
                    j++;
                }
            }
        }
        

        // var geometry = new THREE.BufferGeometry();
        // geometry.addAttribute( 'position', new THREE.Float32BufferAttribute( vertices, 3 ) );
        // geometry.addAttribute( 'color', new THREE.Float32BufferAttribute( {color: 0x993399}, 3 ) );

        
       
    
        // var LineSegments = new THREE.LineSegments( geometry, material3);
        // LineSegments.scale.set(1,1,1.77);
        // this.scene.add( LineSegments);
        

        //var geometry2 = new THREE.CylinderGeometry( 20, 20, 200, 32 );
        // var geometry2 = new THREE.SphereGeometry(100, 32, 16);
        // var cylinder = new THREE.Mesh( geometry2, material3 );
        // this.scene.add( cylinder );
        // cylinder.position.y = 130;
        // var glowMesh	= new THREEx.GeometricGlowMesh(cylinder, 0.01, 10);
        // cylinder.add(glowMesh.object3d);
        // var insideUniforms	= glowMesh.insideMesh.material.uniforms;
        // insideUniforms.glowColor.value.set('hotpink');
        // var outsideUniforms	= glowMesh.outsideMesh.material.uniforms;
        // outsideUniforms.glowColor.value.set('hotpink');

        
        
		this.renderer = new THREE.WebGLRenderer( { antialias: true } );
		this.renderer.setPixelRatio( window.devicePixelRatio );
		this.renderer.setSize( window.innerWidth, window.innerHeight );
        this.renderer.shadowMap.enabled = true;
        
       

        
        this.container.appendChild( this.renderer.domElement );
        
        this.controls = new THREE.OrbitControls(this.camera, this.renderer.domElement);
        this.controls.target.set(0, 150, 0);
        //this.controls.minPolarAngle = Math.PI / 2;
        this.controls.maxPolarAngle = Math.PI / 2;
        this.controls.minAzimuthAngle =  Math.PI / 2;
        this.controls.maxAzimuthAngle =  Math.PI / 2;
        //this.controls.mouseButtons.ORBIT = 0;
        this.controls.mouseButtons.PAN = 0;
        // if (this.controls.maxPolarAngle == Math.PI / 2) {
        this.controls.enableZoom = false;
        // }
        
        this.controls.update();
			
        window.addEventListener( 'resize', function(){ game.onWindowResize(); }, false );
        
	}
	
	onWindowResize() {
		this.camera.aspect = window.innerWidth / window.innerHeight;
		this.camera.updateProjectionMatrix();

		this.renderer.setSize( window.innerWidth, window.innerHeight );

	}

	animate() {
		const game = this;
		const dt = this.clock.getDelta();
		
        requestAnimationFrame( function(){ game.animate(); } );

		this.renderer.render( this.scene, this.camera );

    }

}