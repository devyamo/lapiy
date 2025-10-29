import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
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

const phcs = {
    store: Object.assign(store, store),
    destroy: Object.assign(destroy, destroy),
}

export default phcs