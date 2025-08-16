'use client';

import "@/app/globals.css";
import React from "react";
import {usePathname} from "next/navigation";
import appConfig from "@/appConfig";

export default function RootLayout({children,}: {
    children: React.ReactNode;
}) {

    const pathname = usePathname();

    const locale = appConfig.locales.includes(pathname.split('/')[1]) ? pathname.split('/')[1] : appConfig.defaultLocale;

    return (
        <html lang={locale}>
            <body className="flex flex-col h-screen">
                {children}
            </body>
        </html>
    );
}
