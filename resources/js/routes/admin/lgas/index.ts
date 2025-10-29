import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PhcController::wards
* @see app/Http/Controllers/Admin/PhcController.php:58
* @route '/admin/lgas/{lga}/wards'
*/
export const wards = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: wards.url(args, options),
    method: 'get',
})

wards.definition = {
    methods: ["get","head"],
    url: '/admin/lgas/{lga}/wards',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PhcController::wards
* @see app/Http/Controllers/Admin/PhcController.php:58
* @route '/admin/lgas/{lga}/wards'
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
* @see \App\Http\Controllers\Admin\PhcController::wards
* @see app/Http/Controllers/Admin/PhcController.php:58
* @route '/admin/lgas/{lga}/wards'
*/
wards.get = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: wards.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Admin\PhcController::wards
* @see app/Http/Controllers/Admin/PhcController.php:58
* @route '/admin/lgas/{lga}/wards'
*/
wards.head = (args: { lga: string | number } | [lga: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: wards.url(args, options),
    method: 'head',
})

const lgas = {
    wards: Object.assign(wards, wards),
}

export default lgas