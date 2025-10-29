import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PhcController::store
* @see app/Http/Controllers/Admin/PhcController.php:27
* @route '/admin/phcs'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/phcs',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\PhcController::store
* @see app/Http/Controllers/Admin/PhcController.php:27
* @route '/admin/phcs'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PhcController::store
* @see app/Http/Controllers/Admin/PhcController.php:27
* @route '/admin/phcs'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Admin\PhcController::destroy
* @see app/Http/Controllers/Admin/PhcController.php:64
* @route '/admin/phcs/{phc}'
*/
export const destroy = (args: { phc: number | { id: number } } | [phc: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/phcs/{phc}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\PhcController::destroy
* @see app/Http/Controllers/Admin/PhcController.php:64
* @route '/admin/phcs/{phc}'
*/
destroy.url = (args: { phc: number | { id: number } } | [phc: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { phc: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { phc: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            phc: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        phc: typeof args.phc === 'object'
        ? args.phc.id
        : args.phc,
    }

    return destroy.definition.url
            .replace('{phc}', parsedArgs.phc.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PhcController::destroy
* @see app/Http/Controllers/Admin/PhcController.php:64
* @route '/admin/phcs/{phc}'
*/
destroy.delete = (args: { phc: number | { id: number } } | [phc: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Admin\PhcController::getWardsByLga
* @see app/Http/Controllers/Admin/PhcController.php:58
* @route '/admin/lgas/{lga}/wards'
*/
export const getWardsByLga = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getWardsByLga.url(args, options),
    method: 'get',
})

getWardsByLga.definition = {
    methods: ["get","head"],
    url: '/admin/lgas/{lga}/wards',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PhcController::getWardsByLga
* @see app/Http/Controllers/Admin/PhcController.php:58
* @route '/admin/lgas/{lga}/wards'
*/
getWardsByLga.url = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return getWardsByLga.definition.url
            .replace('{lga}', parsedArgs.lga.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PhcController::getWardsByLga
* @see app/Http/Controllers/Admin/PhcController.php:58
* @route '/admin/lgas/{lga}/wards'
*/
getWardsByLga.get = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getWardsByLga.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PhcController::getWardsByLga
* @see app/Http/Controllers/Admin/PhcController.php:58
* @route '/admin/lgas/{lga}/wards'
*/
getWardsByLga.head = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getWardsByLga.url(args, options),
    method: 'head',
})

const PhcController = { store, destroy, getWardsByLga }

export default PhcController