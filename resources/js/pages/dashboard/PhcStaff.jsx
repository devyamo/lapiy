import React from 'react';
import AppLayout from '@/Layouts/AppLayout';
import { Head } from '@inertiajs/react';

export default function PhcStaffDashboard({ auth }) {
    return (
        <AppLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">PHC Staff Dashboard</h2>}
        >
            <Head title="PHC Staff Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h1 className="text-2xl font-bold mb-4">Welcome to PHC Staff Dashboard</h1>
                            <p>This is the PHC staff dashboard for Lafiyar Iyali Project.</p>
                            <div className="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div className="bg-blue-50 p-4 rounded-lg">
                                    <h3 className="text-lg font-semibold">My Patients</h3>
                                    <p className="text-2xl">0</p>
                                </div>
                                <div className="bg-green-50 p-4 rounded-lg">
                                    <h3 className="text-lg font-semibold">ANC4 Completed</h3>
                                    <p className="text-2xl">0</p>
                                </div>
                                <div className="bg-yellow-50 p-4 rounded-lg">
                                    <h3 className="text-lg font-semibold">Pending Follow-ups</h3>
                                    <p className="text-2xl">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}