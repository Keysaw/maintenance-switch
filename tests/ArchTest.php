<?php

it('does not use debugging functions')
	->expect(['dd', 'dump', 'ray', 'var_dump'])
	->not->toBeUsed();
