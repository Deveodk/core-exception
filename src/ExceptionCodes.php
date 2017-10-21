<?php

namespace DeveoDK\Core\Exception;

/**
 * Creation of a new entity failed
 */
define("CREATION_FAILED", 1000);

/**
 * Deletion of a entity failed
 */
define("DELETION_FAILED", 1001);

/**
 * Updating a entity failed
 */
define("UPDATE_FAILED", 1002);

/**
 * Reading of a entity failed
 */
define("READ_FAILED", 1003);

/**
 * The notification failed to send
 */
define("NOTIFICATION_FAILED", 2000);

/**
 * The rate limit was activated
 */
define("RATE_LIMIT", 3000);

/**
 * The requested method was not allowed
 */
define("METHOD_NOT_ALLOWED", 3001);

/**
 * The resource was not found
 */
define("RESOURCE_NOT_FOUND", 3002);

/**
 * You are unauthorized to see the requested resource
 */
define("UNAUTHORIZED", 4000);

/**
 * The OAUTH2 Callback failed
 */
define("OAUTH2_CALLBACK_FAILED", 4001);

/**
 * There have been to many login attempts
 */
define("TO_MANY_LOGIN_ATTEMPTS", 4002);
