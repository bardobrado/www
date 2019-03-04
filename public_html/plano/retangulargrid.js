/**
 * @author mrdoob / http://mrdoob.com/
 */

import { LineSegments } from '../objects/LineSegments.js';
import { VertexColors } from '../constants.js';
import { LineBasicMaterial } from '../materials/LineBasicMaterial.js';
import { Float32BufferAttribute } from '../core/BufferAttribute.js';
import { BufferGeometry } from '../core/BufferGeometry.js';
import { Color } from '../math/Color.js';

function RetangularGrid( size, divisions, width, height, color1, color2 ) {
    THREE.GridHelper.
	size = size || 10;
	divisions = divisions || 10;
	color1 = new Color( color1 !== undefined ? color1 : 0x444444 );
	color2 = new Color( color2 !== undefined ? color2 : 0x888888 );

	var center = divisions / 2;
	var step = size / divisions;
    var halfSize = size / 2;
    var halfwidht = width / 2;
    var halfheight = height / 2;

	var vertices = [], colors = [];

	for ( var i = 0, j = 0, k = - halfSize; i <= divisions; i ++, k += step ) {

		vertices.push( - halfSize - halfwidht, 0, k, halfSize + halfheight, 0, k );
		vertices.push( k + halfwidht, 0, - halfSize - halfheight, k, 0, halfSize );

		var color = i === center ? color1 : color2;

		color.toArray( colors, j ); j += 3;
		color.toArray( colors, j ); j += 3;
		color.toArray( colors, j ); j += 3;
		color.toArray( colors, j ); j += 3;

	}

	var geometry = new BufferGeometry();
	geometry.addAttribute( 'position', new Float32BufferAttribute( vertices, 3 ) );
	geometry.addAttribute( 'color', new Float32BufferAttribute( colors, 3 ) );

	var material = new LineBasicMaterial( { vertexColors: VertexColors } );

	LineSegments.call( this, geometry, material );

}

RetangularGrid.prototype = Object.create( LineSegments.prototype );
RetangularGrid.prototype.constructor = RetangularGrid;

export { RetangularGrid };