<?php

/**
 * Assert that the application is up.
 */
function assertUp() : mixed
{
	expect(app()->isDownForMaintenance())
		->toBeFalse('The application is expected to be up, but is currently down.');

	return test();
}

/**
 * Assert that the application is down for maintenance.
 */
function assertDown() : mixed
{
	expect(app()->isDownForMaintenance())
		->toBeTrue('The application is expected to be down, but is currently up.');

	return test();
}
