import { queryParams, type RouteQueryOptions, type RouteDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\DashboardController::index
* @see app/Http/Controllers/DashboardController.php:15
* @route '/admin/dashboard'
*/
const index750aeb224105761400ee952169bd178c = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index750aeb224105761400ee952169bd178c.url(options),
    method: 'get',
})

index750aeb224105761400ee952169bd178c.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\DashboardController::index
* @see app/Http/Controllers/DashboardController.php:15
* @route '/admin/dashboard'
*/
index750aeb224105761400ee952169bd178c.url = (options?: RouteQueryOptions) => {
    return index750aeb224105761400ee952169bd178c.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\DashboardController::index
* @see app/Http/Controllers/DashboardController.php:15
* @route '/admin/dashboard'
*/
index750aeb224105761400ee952169bd178c.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index750aeb224105761400ee952169bd178c.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\DashboardController::index
* @see app/Http/Controllers/DashboardController.php:15
* @route '/admin/dashboard'
*/
index750aeb224105761400ee952169bd178c.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index750aeb224105761400ee952169bd178c.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\DashboardController::index
* @see app/Http/Controllers/DashboardController.php:15
* @route '/phcstaff/dashboard'
*/
const index7d49221e14bd5c3d6e416c041515b90e = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index7d49221e14bd5c3d6e416c041515b90e.url(options),
    method: 'get',
})

index7d49221e14bd5c3d6e416c041515b90e.definition = {
    methods: ["get","head"],
    url: '/phcstaff/dashboard',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\DashboardController::index
* @see app/Http/Controllers/DashboardController.php:15
* @route '/phcstaff/dashboard'
*/
index7d49221e14bd5c3d6e416c041515b90e.url = (options?: RouteQueryOptions) => {
    return index7d49221e14bd5c3d6e416c041515b90e.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\DashboardController::index
* @see app/Http/Controllers/DashboardController.php:15
* @route '/phcstaff/dashboard'
*/
index7d49221e14bd5c3d6e416c041515b90e.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index7d49221e14bd5c3d6e416c041515b90e.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\DashboardController::index
* @see app/Http/Controllers/DashboardController.php:15
* @route '/phcstaff/dashboard'
*/
index7d49221e14bd5c3d6e416c041515b90e.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index7d49221e14bd5c3d6e416c041515b90e.url(options),
    method: 'head',
})

export const index = {
    '/admin/dashboard': index750aeb224105761400ee952169bd178c,
    '/phcstaff/dashboard': index7d49221e14bd5c3d6e416c041515b90e,
}

const DashboardController = { index }

export default DashboardController