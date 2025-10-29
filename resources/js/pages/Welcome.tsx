import { Link } from '@inertiajs/react';
import React from 'react';

export default function Welcome({ canLogin, canRegister, laravelVersion, phpVersion }: any) {
    return (
        <>
            <Head title="Welcome" />
            <div className="relative isolate min-h-screen bg-gray-50 dark:bg-gray-900">
                <nav className="flex justify-end p-6 lg:px-8">
                    {canLogin ? (
                        <div className="space-x-4">
                            <Link
                                href={route('login')}
                                className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:outline-red-500"
                            >
                                Log in
                            </Link>

                            {canRegister && (
                                <Link
                                    href={route('register')}
                                    className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:outline-red-500"
                                >
                                    Register
                                </Link>
                            )}
                        </div>
                    ) : null}
                </nav>

                <div className="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
                    <div className="mx-auto max-w-2xl text-center">
                        <h1 className="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl">
                            Lafiyar Iyali Project
                        </h1>
                        <p className="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-400">
                            Maternal Health Tracking System
                        </p>
                    </div>
                </div>
            </div>
        </>
    );
}

// NOTE: You also need to import Head from '@inertiajs/react'
import { Head } from '@inertiajs/react';