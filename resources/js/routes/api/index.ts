import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \App\Http\Controllers\PatientController::lgas
* @see app/Http/Controllers/PatientController.php:119
* @route '/api/lgas'
*/
export const lgas = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: lgas.url(options),
    method: 'get',
})

lgas.definition = {
    methods: ["get","head"],
    url: '/api/lgas',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PatientController::lgas
* @see app/Http/Controllers/PatientController.php:119
* @route '/api/lgas'
*/
lgas.url = (options?: RouteQueryOptions) => {
    return lgas.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PatientController::lgas
* @see app/Http/Controllers/PatientController.php:119
* @route '/api/lgas'
*/
lgas.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: lgas.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PatientController::lgas
* @see app/Http/Controllers/PatientController.php:119
* @route '/api/lgas'
*/
lgas.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: lgas.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PatientController::wards
* @see app/Http/Controllers/PatientController.php:124
* @route '/api/lgas/{lga}/wards'
*/
export const wards = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: wards.url(args, options),
    method: 'get',
})

wards.definition = {
    methods: ["get","head"],
    url: '/api/lgas/{lga}/wards',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PatientController::wards
* @see app/Http/Controllers/PatientController.php:124
* @route '/api/lgas/{lga}/wards'
*/
wards.url = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { lga: args }
    }

    if (Array.isArray(args)) {
        args = {
            lga: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        lga: args.lga,
    }

    return wards.definition.url
            .replace('{lga}', parsedArgs.lga.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PatientController::wards
* @see app/Http/Controllers/PatientController.php:124
* @route '/api/lgas/{lga}/wards'
*/
wards.get = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: wards.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\PatientController::wards
* @see app/Http/Controllers/PatientController.php:124
* @route '/api/lgas/{lga}/wards'
*/
wards.head = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: wards.url(args, options),
    method: 'head',
})

const api = {
    lgas: Object.assign(lgas, lgas),
    wards: Object.assign(wards, wards),
}

export default api